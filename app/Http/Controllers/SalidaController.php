<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Tipo;
use App\Producto;
use App\Entidad;
use App\Salida;
use App\Detalle, App\PedidoProducto;
use App\Comprador;
use Carbon\Carbon;
use PDF;

class SalidaController extends Controller
{
  public function verSalidas()
  {
    $salidas = DB::table('salidas')
      ->join('tipos', 'salidas.tipo_id', 'tipos.id')
      ->select('salidas.fecha_emision', 'salidas.correlativo_factura', 'salidas.total', 'salidas.tipo_factura', 'tipos.nombre', 'salidas.id')
      ->orderBy('salidas.fecha_emision', 'desc')
      ->get();
    return view('salidas.verSalidas', compact('salidas'));
  }

  public function index()
  {
    $totalSalidas = DB::table('salidas')->count();
    $salidaActual = $totalSalidas + 1;
    $tipos = Tipo::all();
    $productos = DB::table('productos')
      ->select('id', 'nombre')
      ->where('existencias', '>', 0)
      ->get();
    return view('salidas.salida', compact('salidaActual', 'tipos', 'productos'));
  }



  public function indexVenta()
  {
    $totalSalidas = DB::table('salidas')->count();
    $salidaActual = $totalSalidas + 1;
    $tipos = Tipo::all();
    $productos = DB::table('productos')
      ->select('id', 'nombre')
      ->where('existencias', '>', 0)
      ->get();
    $hoyCarbon = (string) Carbon::today('America/El_Salvador');
    $hoy = substr($hoyCarbon, 0, 10);
    $promociones = DB::table('promociones')
      ->whereDate('fecha_fin', '>=', $hoy)
      ->get();
    $entidades = Entidad::orderBy('nombre')->get();
    return view('salidas.venta', compact('salidaActual', 'tipos', 'productos', 'promociones', 'entidades'));
  }

  public function validarFechaMayorDeHoy($fechaRecepcion)
  {
    $fechaMayor = False;
    $hoy = Carbon::today('America/El_Salvador');

    $stringFecha = explode("/", $fechaRecepcion);
    $diaIngresado = (int) $stringFecha[0];
    $mesIngresado = (int) $stringFecha[1];
    $anioIngresado = (int) $stringFecha[2];

    $fechaIngresada = Carbon::create($anioIngresado, $mesIngresado, $diaIngresado, 0, 0, 0);

    if ($fechaIngresada->greaterThan($hoy)) {
      $fechaMayor = True;
    }

    return $fechaMayor;
  }

  public function verificarSalida(Request $request)
  {
    $this->validate($request, [
      'tipo' => 'required',
      'fecha_emision' => 'required'
    ]);

    $fechaMayorAHoy = self::validarFechaMayorDeHoy($request->fecha_emision);
    if ($fechaMayorAHoy) {
      return redirect('/salida')->with('error', 'No es posible ingresar una fecha mayor a la del dia de hoy');
    }

    $tipoSalida = DB::table('tipos')
      ->select('nombre')
      ->where('id', (int) $request->tipo)
      ->get();

    $datos = $request;
    $productos = $request->producto;
    $datosProductos = array();
    foreach ($productos as $producto) {
      $datosProductos[] = DB::table('productos')
        ->where('id', $producto)
        ->get();
    }
    return view('salidas.verificarSalida', compact('datos', 'datosProductos', 'tipoSalida'));
  }

  public function verificarVenta(Request $request)
  {
    $this->validate($request, [
      'tipo' => 'required',
      'fecha_emision' => 'required',
      'correlativo_factura' => 'required',
      'factura' => 'required'
    ]);

    $fechaMayorAHoy = self::validarFechaMayorDeHoy($request->fecha_emision);
    if ($fechaMayorAHoy) {
      return redirect('/salida/venta')->with('error', 'No es posible ingresar una fecha mayor a la del dia de hoy');
    }

    $productosPromocion = null;
    if ($request->promocion) {
      $productosPromocion = DB::table('promociones')
        ->join('producto_promocion', 'producto_promocion.promocion_id', 'promociones.id')
        ->join('productos', 'productos.id', 'producto_promocion.producto_id')
        ->select('promociones.nombre', 'productos.nombre', 'producto_promocion.cantidad', 'producto_promocion.precio_unitario')
        ->where('promociones.nombre', $request->promocion)
        ->get();
    }

    $datos = $request;
    $productos = $request->producto;
    $datosProductos = array();
    foreach ($productos as $producto) {
      $datosProductos[] = DB::table('productos')
        ->where('id', $producto)
        ->get();
    }

    $tipoSalida = DB::table('tipos')
      ->select('nombre')
      ->where('id', (int) $request->tipo)
      ->get();

    return view('salidas.verificarVenta', compact('datos', 'datosProductos', 'tipoSalida', 'productosPromocion'));
  }

  public function obtenerPedido($nombreProducto)
  {
    $pedido = DB::table('pedidos')
      ->join('pedido_producto', 'pedidos.id', 'pedido_producto.pedido_id')
      ->join('productos', 'productos.id', 'pedido_producto.producto_id')
      ->select('pedido_producto.id', 'pedidos.fecha_solicitud', 'pedido_producto.cantidad_ordenada', 'pedido_producto.salidas')
      ->where('productos.nombre', $nombreProducto)
      ->whereRaw('pedido_producto.salidas < pedido_producto.cantidad_ordenada and pedido_producto.fecha_recibido <> "NULL"')
      ->groupBy('pedido_producto.id', 'pedidos.fecha_solicitud', 'pedido_producto.cantidad_ordenada', 'pedido_producto.salidas')
      ->orderBy('pedidos.fecha_solicitud')
      ->first();

    return $pedido;
  }

  public function nuevoDetalle($salida, $pedido, $totalProducto, $cantidad)
  {
    $detalle = new Detalle;
    $detalle->salida_id = $salida;
    $detalle->pedido_producto_id = $pedido;
    $detalle->total = (float) $totalProducto;
    $detalle->cantidad_vendida = (int) $cantidad;
    $detalle->save();
    return $detalle;
  }

  public function nuevaSalida($tipoRequest, $fechaEmision, $total, $comentario, $total_iva)
  {
    $salida = new Salida;
    $tipoQuery = DB::table('tipos')
      ->select('id')
      ->where('nombre', $tipoRequest)
      ->get();
    $tipo = $tipoQuery[0]->id;
    $salida->tipo_id = $tipo;
    $salida->fecha_emision = $fechaEmision;
    $salida->total = (float) $total;
    $salida->total_iva = (float) $total_iva;
    $salida->comentario = $comentario;
    $salida->save();
    return $salida;
  }

  public function actualizarPedidoProducto($id, $salidas)
  {
    $pedido_producto = PedidoProducto::find($id);
    $pedido_producto->salidas = $salidas;
    $pedido_producto->save();
    return $pedido_producto;
  }

  public function actualizarDatosDetalle($detalle, $precio, $cantidad, $pedido_producto, $existencias)
  {
    $detalle->total = $precio * $cantidad;
    $detalle->cantidad_vendida = $cantidad;
    $query = DB::table('pedido_producto')
      ->select('costo_unitario', 'id')
      ->where('id', $pedido_producto)
      ->get()
      ->toArray();
    $detalle->costo = round($query[0]->costo_unitario * $cantidad, 2);
    $detalle->existencias = $existencias - 1;
    $detalle->save();
  }

  public function store(Request $request)
  {
    $salida = self::nuevaSalida($request->tipo, $request->fecha_emision, $request->total, $request->comentario, $request->total_iva);

    for ($i = 0; $i < count($request->producto); $i++) {
      $productoQuery = DB::table('productos')
        ->select('id', 'existencias')
        ->where('nombre', $request->producto[$i])
        ->get()
        ->toArray();
      $idProducto = $productoQuery['0']->id;
      $existencias = $productoQuery['0']->existencias;
      $producto = Producto::find($idProducto);
      $cantidad = 0;
      $unidadesActuales = $request->cantidad[$i];
      $pedido = (array) self::obtenerPedido($request->producto[$i]);
      if ($pedido == null) {
        return redirect('/salida')->with('error', 'No hay pedidos para uno de los productos seleccionados');
      }
      $detalle = self::nuevoDetalle($salida->id, $pedido['id'], (float) $request->totalProducto[$i], $cantidad);
      $cantidadOrdenada = $pedido['cantidad_ordenada'];
      $salidas = $pedido['salidas'];
      $pedido_producto = DB::table('pedido_producto')
        ->select('id')
        ->orderBy('updated_at', 'desc')
        ->orderBy('salidas', 'desc')
        ->first();
      for ($j = 0; $j < (int) $unidadesActuales; $j++) {
        if ($salidas < $cantidadOrdenada && (int) $request->cantidad[$i] != 0) {
          $cantidad++;
          $salidas++;
          $pedido_producto = self::actualizarPedidoProducto($pedido['id'], $salidas);
          $existencias--;
          $producto->existencias = $existencias;
          $producto->save();
          self::actualizarDatosDetalle($detalle, $request->precio[$i], $cantidad, $pedido_producto->id, $existencias + 1);
        } else {
          if ((int) $request->cantidad[$i] != 0) {
            $pedido = (array) self::obtenerPedido($request->producto[$i]);
            if ($pedido == null) {
              return redirect('/salida')->with('error', 'No hay pedidos para uno de los productos seleccionados');
            }
            $productoQuery = DB::table('productos')
              ->select('id', 'existencias')
              ->where('nombre', $request->producto[$i])
              ->get()
              ->toArray();
            $idProducto = $productoQuery['0']->id;
            $existencias = $productoQuery['0']->existencias - 1;
            $producto->existencias = $existencias;
            $producto->save();
            $cantidad = 1;
            $detalle = self::nuevoDetalle($salida->id, $pedido['id'], (float) $request->totalProducto[$i], $cantidad);
            $cantidadOrdenada = $pedido['cantidad_ordenada'];
            $salidas = $pedido['salidas'] + 1;
            $pedido_producto = self::actualizarPedidoProducto($pedido['id'], $salidas);
            $pedido_producto = DB::table('pedido_producto')
              ->join('productos', 'pedido_producto.producto_id', 'productos.id')
              ->select('pedido_producto.id')
              ->where('productos.nombre', $request->producto[$i])
              ->whereRaw('pedido_producto.salidas<pedido_producto.cantidad_ordenada')
              ->orderBy('pedido_producto.updated_at', 'desc')
              ->first();
            self::actualizarDatosDetalle($detalle, $request->precio[$i], $cantidad, $pedido_producto->id, $existencias + 1);
          }
        }
      }
    }

    return redirect('/versalidas')->with('success', 'Se ha registrado la salida');
  }

  public function nuevaSalidaVenta($tipoRequest, $fechaEmision, $total, $promocion, $correlativo_factura, $tipo_factura, $cantidad_promociones, $total_iva)
  {
    $salida = new Salida;
    $tipoQuery = DB::table('tipos')
      ->select('id')
      ->where('nombre', $tipoRequest)
      ->get();
    $tipo = $tipoQuery[0]->id;
    $salida->tipo_id = $tipo;
    $salida->fecha_emision = $fechaEmision;
    $salida->total = (float) $total;
    $salida->total_iva = (float) $total_iva;
    $salida->promocion = $promocion;
    $salida->correlativo_factura = $correlativo_factura;
    $salida->tipo_factura = $tipo_factura;
    $salida->cantidad_promociones = (int) $cantidad_promociones;
    $salida->save();
    return $salida;
  }

  public function compradorFacturaSencilla($nombre, $salida)
  {
    $comprador = new Comprador;
    $comprador->nombre = $nombre;
    $comprador->save();
    $idComprador = DB::table('compradores')
      ->select('id')
      ->orderBy('created_at', 'desc')
      ->first();
    $salida->compradores()->attach($idComprador);
  }

  public function compradorFacturaConsumidorFinal($nombre, $dui, $direccion, $cuenta, $salida)
  {
    $comprador = new Comprador;
    $comprador->nombre = $nombre;
    $comprador->dui = $dui;
    $comprador->direccion = $direccion;
    $comprador->cuenta = $cuenta;
    $comprador->save();
    $idComprador = DB::table('compradores')
      ->select('id')
      ->orderBy('created_at', 'desc')
      ->first();
    $salida->compradores()->attach($idComprador);
  }

  public function guardarEntidad($entidad, $salida)
  {
    $idEntidad = DB::table('entidades')
      ->select('id')
      ->where('nombre', $entidad)
      ->get();
    $salida->entidades()->attach($idEntidad[0]->id);
  }

  public function obtenerFechaActual()
  {
    $hoy = (Carbon::today('America/El_Salvador'))->toArray();
    return $hoy;
  }

  public function generarFacturaSencilla(Request $request)
  {
    $fecha = self::obtenerFechaActual();

    $data = [
      'dia' => $fecha['day'],
      'mes' => $fecha['month'],
      'anio' => $fecha['year'],
      'ventas_gravadas' => $request->total,
      'subtotal' => $request->total_iva,
      'nombre' => $request->nombre_comprador
    ];

    $pdf = PDF::loadView('salidas.facturaSencilla', $data);
    return $pdf->download('factura-sencilla-' . $request->correlativo_factura . '.pdf');
  }

  public function generarFacturaConsumidorFinal(Request $request)
  {
    $fecha = self::obtenerFechaActual();

    $data = [
      'dia' => $fecha['day'],
      'mes' => $fecha['month'],
      'anio' => $fecha['year'],
      'nombre' => $request->nombre_comprador,
      'dui' => $request->dui,
      'direccion' => $request->direccion,
      'cuenta' => $request->cuenta,
      'producto' => $request->producto,
      'cantidad' => $request->cantidad,
      'precio' => $request->precio,
      'totalProducto' => $request->totalProducto,
      'sumas' => $request->total,
      'iva' => round(($request->total * 0.13), 2),
      'subtotal' => $request->total_iva,
    ];

    $pdf = PDF::loadView('salidas.facturaConsumidorFinal', $data);
    return $pdf->download('factura-consumidor-final-' . $request->correlativo_factura . '.pdf');
  }

  public function generarCreditoFiscal(Request $request)
  {
    $fecha = self::obtenerFechaActual();

    $entidad = DB::table('entidades')
      ->where('nombre', $request->entidad)
      ->get()
      ->toArray();

    $data = [
      'dia' => $fecha['day'],
      'mes' => $fecha['month'],
      'anio' => $fecha['year'],
      'nombre' => $request->nombre_comprador,
      'dui' => $request->dui,
      'direccion' => $request->direccion,
      'cuenta' => $request->cuenta,
      'producto' => $request->producto,
      'cantidad' => $request->cantidad,
      'precio' => $request->precio,
      'totalProducto' => $request->totalProducto,
      'sumas' => $request->total,
      'iva' => round(($request->total * 0.13), 2),
      'subtotal' => $request->total_iva,
      'nombre' => $entidad[0]->nombre,
      'direccion' => strlen($entidad[0]->direccion) > 16 ? $direccion = substr($entidad[0]->direccion, 0, 17) : $direccion = $entidad[0]->direccion,
      'nit' => $entidad[0]->nit,
      'numero_registro' => $entidad[0]->numero_registro,
      'giro' => $entidad[0]->giro,
    ];

    $pdf = PDF::loadView('salidas.creditoFiscal', $data);
    return $pdf->download('credito-fiscal-' . $request->correlativo_factura . '.pdf');
  }

  public function storeVenta(Request $request)
  {
    switch ($request->input('action')) {
      case 'generarFactura':
        if ($request->factura == "Sencilla") {
          return redirect()->route('facturaSencilla', [$request]);
        } elseif ($request->factura == "Consumidor final") {
          return redirect()->route('facturaConsumidorFinal', [$request]);
        } elseif ($request->factura == "Crédito fiscal") {
          return redirect()->route('creditoFiscal', [$request]);
        }

        break;
      case 'guardar':
        $salida = self::nuevaSalidaVenta($request->tipo, $request->fecha_emision, $request->total, $request->promocion, $request->correlativo_factura, $request->factura, $request->cantidad_promociones, $request->total_iva);
        for ($i = 0; $i < count($request->producto); $i++) {
          $productoQuery = DB::table('productos')
            ->select('id', 'existencias')
            ->where('nombre', $request->producto[$i])
            ->get()
            ->toArray();
          $idProducto = $productoQuery['0']->id;
          $existencias = $productoQuery['0']->existencias;
          $producto = Producto::find($idProducto);
          $cantidad = 0;
          $unidadesActuales = $request->cantidad[$i];
          $pedido = (array) self::obtenerPedido($request->producto[$i]);
          if ($pedido == null) {
            return redirect('/salida/venta')->with('error', 'No hay pedidos para uno de los productos seleccionados');
          }
          $detalle = self::nuevoDetalle($salida->id, $pedido['id'], (float) $request->totalProducto[$i], $cantidad);
          $cantidadOrdenada = $pedido['cantidad_ordenada'];
          $salidas = $pedido['salidas'];
          $pedido_producto = DB::table('pedido_producto')
            ->select('id')
            ->orderBy('updated_at', 'desc')
            ->orderBy('salidas', 'desc')
            ->first();
          for ($j = 0; $j < (int) $unidadesActuales; $j++) {
            if ($salidas < $cantidadOrdenada && (int) $request->cantidad[$i] != 0) {
              $cantidad++;
              $salidas++;
              $pedido_producto = self::actualizarPedidoProducto($pedido['id'], $salidas);

              self::actualizarDatosDetalle($detalle, $request->precio[$i], $cantidad, $pedido_producto->id, $existencias);
              $existencias--;
              $producto->existencias = $existencias;
              $producto->save();
            } else {
              if ((int) $request->cantidad[$i] != 0) {
                $pedido = (array) self::obtenerPedido($request->producto[$i]);
                if ($pedido == null) {
                  return redirect('/salida/venta')->with('error', 'No hay pedidos para uno de los productos seleccionados');
                }
                $productoQuery = DB::table('productos')
                  ->select('id', 'existencias')
                  ->where('nombre', $request->producto[$i])
                  ->get()
                  ->toArray();
                $idProducto = $productoQuery['0']->id;
                $existencias = $productoQuery['0']->existencias - 1;
                $producto->existencias = $existencias;
                $producto->save();
                $cantidad = 1;
                $detalle = self::nuevoDetalle($salida->id, $pedido['id'], (float) $request->totalProducto[$i], $cantidad);
                $cantidadOrdenada = $pedido['cantidad_ordenada'];
                $salidas = $pedido['salidas'] + 1;
                $pedido_producto = self::actualizarPedidoProducto($pedido['id'], $salidas);
                $pedido_producto = DB::table('pedido_producto')
                  ->join('productos', 'pedido_producto.producto_id', 'productos.id')
                  ->select('pedido_producto.id')
                  ->where('productos.nombre', $request->producto[$i])
                  ->whereRaw('pedido_producto.salidas<pedido_producto.cantidad_ordenada')
                  ->orderBy('pedido_producto.updated_at', 'desc')
                  ->first();
                self::actualizarDatosDetalle($detalle, $request->precio[$i], $cantidad, $pedido_producto->id, $existencias);
              }
            }
          }
        }
        if ($request->factura == "Sencilla") {
          self::compradorFacturaSencilla($request->nombre_comprador, $salida);
        } elseif ($request->factura == "Consumidor final") {
          self::compradorFacturaConsumidorFinal($request->nombre_comprador, $request->dui, $request->direccion, $request->cuenta, $salida);
        } elseif ($request->factura == "Crédito fiscal") {
          self::guardarEntidad($request->entidad, $salida);
        }

        return redirect('/versalidas')->with('success', 'Se ha registrado la salida');
        break;
    }
  }

  public function show()
  {
    $salida = DB::table('salidas')
      ->join('detalles', 'salidas.id', 'detalles.salida_id')
      ->join('pedido_producto', 'detalles.pedido_producto_id', 'pedido_producto.id')
      ->join('productos', 'productos.id', 'pedido_producto.id')
      ->where('detalles.cantidad_vendida', '<>', 0)
      ->get();

    $tipos = DB::table('tipos')
      ->select('nombre')
      ->where('id', $salida[0]->tipo_id)
      ->get();
    $tipo = $tipos[0]->nombre;

    return view('salidas.show', compact('salida', 'tipo'));
  }

  // Obtener los totales de ventas realizadas en el anio actual
  public function ObtenerTotalVentasAnioActual()
  {
    $anio = "actual";
    $totalEne = DB::table('salidas')->whereMonth('fecha_emision', '1')->whereYear('fecha_emision', date("Y"))->get();
    $totalFeb = DB::table('salidas')->whereMonth('fecha_emision', '2')->whereYear('fecha_emision', date("Y"))->get();
    $totalMar = DB::table('salidas')->whereMonth('fecha_emision', '3')->whereYear('fecha_emision', date("Y"))->get();
    $totalAbr = DB::table('salidas')->whereMonth('fecha_emision', '4')->whereYear('fecha_emision', date("Y"))->get();
    $totalMay = DB::table('salidas')->whereMonth('fecha_emision', '5')->whereYear('fecha_emision', date("Y"))->get();
    $totalJun = DB::table('salidas')->whereMonth('fecha_emision', '6')->whereYear('fecha_emision', date("Y"))->get();
    $totalJul = DB::table('salidas')->whereMonth('fecha_emision', '7')->whereYear('fecha_emision', date("Y"))->get();
    $totalAgo = DB::table('salidas')->whereMonth('fecha_emision', '8')->whereYear('fecha_emision', date("Y"))->get();
    $totalSep = DB::table('salidas')->whereMonth('fecha_emision', '9')->whereYear('fecha_emision', date("Y"))->get();
    $totalOct = DB::table('salidas')->whereMonth('fecha_emision', '10')->whereYear('fecha_emision', date("Y"))->get();
    $totalNov = DB::table('salidas')->whereMonth('fecha_emision', '11')->whereYear('fecha_emision', date("Y"))->get();
    $totalDic = DB::table('salidas')->whereMonth('fecha_emision', '12')->whereYear('fecha_emision', date("Y"))->get();

    $sumEne = 0;
    foreach ($totalEne as $totalE) {
      if ($totalE->tipo_id == 1) {
        $sumEne = $totalE->total + $sumEne;
      }
    }

    $sumFeb = 0;
    foreach ($totalFeb as $totalF) {
      if ($totalF->tipo_id == 1) {
        $sumFeb = $totalF->total + $sumFeb;
      }
    }

    $sumMar = 0;
    foreach ($totalMar as $totalM) {
      if ($totalM->tipo_id == 1) {
        $sumMar = $totalM->total + $sumMar;
      }
    }

    $sumAbr = 0;
    foreach ($totalAbr as $totalA) {
      if ($totalA->tipo_id == 1) {
        $sumAbr = $totalA->total + $sumAbr;
      }
    }

    $sumMay = 0;
    foreach ($totalMay as $totalMa) {
      if ($totalMa->tipo_id == 1) {
        $sumMay = $totalMa->total + $sumMay;
      }
    }

    $sumJun = 0;
    foreach ($totalJun as $totalJ) {
      if ($totalJ->tipo_id == 1) {
        $sumJun = $totalJ->total + $sumJun;
      }
    }

    $sumJul = 0;
    foreach ($totalJul as $totalJu) {
      if ($totalJu->tipo_id == 1) {
        $sumJul = $totalJu->total + $sumJul;
      }
    }

    $sumAgo = 0;
    foreach ($totalAgo as $totalAg) {
      if ($totalAg->tipo_id == 1) {
        $sumAgo = $totalAg->total + $sumAgo;
      }
    }

    $sumSep = 0;
    foreach ($totalSep as $totalS) {
      if ($totalS->tipo_id == 1) {
        $sumSep = $totalS->total + $sumSep;
      }
    }

    $sumOct = 0;
    foreach ($totalOct as $totalO) {
      if ($totalO->tipo_id == 1) {
        $sumOct = $totalO->total + $sumOct;
      }
    }

    $sumNov = 0;
    foreach ($totalNov as $totalN) {
      if ($totalN->tipo_id == 1) {
        $sumNov = $totalN->total + $sumNov;
      }
    }

    $sumDic = 0;
    foreach ($totalDic as $totalD) {
      if ($totalD->tipo_id == 1) {
        $sumDic = $totalD->total + $sumDic;
      }
    }
    $anios = DB::table('salidas')
      ->selectRaw('distinct(year(fecha_emision)) as fecha')
      ->orderByDesc('fecha_emision')
      ->get()->toArray();
    return view('salidas.reporteVentas', compact('sumEne', 'sumFeb', 'sumMar', 'sumAbr', 'sumMay', 'sumJun', 'sumJul', 'sumAgo', 'sumSep', 'sumOct', 'sumNov', 'sumDic', 'anios', 'anio'));
  }

  public function generarReporteVentas(Request $request)
  {
    $ventas = DB::table('salidas')
      ->join('detalles', 'salidas.id', 'detalles.salida_id')
      ->join('pedido_producto', 'pedido_producto.id', 'detalles.pedido_producto_id')
      ->join('productos', 'productos.id', 'pedido_producto.producto_id')
      ->select('salidas.correlativo_factura', 'salidas.fecha_emision', 'salidas.tipo_factura', 'salidas.total', 'salidas.total_iva', 'detalles.cantidad_vendida', 'productos.nombre')
      ->where('salidas.tipo_id', 1)
      ->whereRaw("year(salidas.fecha_emision) = '$request->fecha'")
      ->orderByDesc('fecha_emision')
      ->get()->toArray();
    $data = [
      'anio' => $request->fecha,
      'ventas' => $ventas
    ];

    $pdf = PDF::loadView('salidas.reporte', $data);
    return $pdf->download('ventas-' . $request->fecha . '.pdf');
  }

  public function obtenerVentas(Request $request)
  {
    switch ($request->input('action')) {
      case 'reporte':
        if ($request->fecha == null) {
          return redirect('/reporteventas')->with('error', 'Debe seleccionar un Año');
        }
        return redirect()->route('reporteVentas', [$request]);
        break;
      case 'filtro':
        if ($request->fecha != null) {
          $totalEne = DB::table('salidas')->whereMonth('fecha_emision', '1')->whereYear('fecha_emision', $request->fecha)->get();
          $totalFeb = DB::table('salidas')->whereMonth('fecha_emision', '2')->whereYear('fecha_emision', $request->fecha)->get();
          $totalMar = DB::table('salidas')->whereMonth('fecha_emision', '3')->whereYear('fecha_emision', $request->fecha)->get();
          $totalAbr = DB::table('salidas')->whereMonth('fecha_emision', '4')->whereYear('fecha_emision', $request->fecha)->get();
          $totalMay = DB::table('salidas')->whereMonth('fecha_emision', '5')->whereYear('fecha_emision', $request->fecha)->get();
          $totalJun = DB::table('salidas')->whereMonth('fecha_emision', '6')->whereYear('fecha_emision', $request->fecha)->get();
          $totalJul = DB::table('salidas')->whereMonth('fecha_emision', '7')->whereYear('fecha_emision', $request->fecha)->get();
          $totalAgo = DB::table('salidas')->whereMonth('fecha_emision', '8')->whereYear('fecha_emision', $request->fecha)->get();
          $totalSep = DB::table('salidas')->whereMonth('fecha_emision', '9')->whereYear('fecha_emision', $request->fecha)->get();
          $totalOct = DB::table('salidas')->whereMonth('fecha_emision', '10')->whereYear('fecha_emision', $request->fecha)->get();
          $totalNov = DB::table('salidas')->whereMonth('fecha_emision', '11')->whereYear('fecha_emision', $request->fecha)->get();
          $totalDic = DB::table('salidas')->whereMonth('fecha_emision', '12')->whereYear('fecha_emision', $request->fecha)->get();

          $sumEne = 0;
          foreach ($totalEne as $totalE) {
            if ($totalE->tipo_id == 1) {
              $sumEne = $totalE->total + $sumEne;
            }
          }

          $sumFeb = 0;
          foreach ($totalFeb as $totalF) {
            if ($totalF->tipo_id == 1) {
              $sumFeb = $totalF->total + $sumFeb;
            }
          }

          $sumMar = 0;
          foreach ($totalMar as $totalM) {
            if ($totalM->tipo_id == 1) {
              $sumMar = $totalM->total + $sumMar;
            }
          }

          $sumAbr = 0;
          foreach ($totalAbr as $totalA) {
            if ($totalA->tipo_id == 1) {
              $sumAbr = $totalA->total + $sumAbr;
            }
          }

          $sumMay = 0;
          foreach ($totalMay as $totalMa) {
            if ($totalMa->tipo_id == 1) {
              $sumMay = $totalMa->total + $sumMay;
            }
          }

          $sumJun = 0;
          foreach ($totalJun as $totalJ) {
            if ($totalJ->tipo_id == 1) {
              $sumJun = $totalJ->total + $sumJun;
            }
          }

          $sumJul = 0;
          foreach ($totalJul as $totalJu) {
            if ($totalJu->tipo_id == 1) {
              $sumJul = $totalJu->total + $sumJul;
            }
          }

          $sumAgo = 0;
          foreach ($totalAgo as $totalAg) {
            if ($totalAg->tipo_id == 1) {
              $sumAgo = $totalAg->total + $sumAgo;
            }
          }

          $sumSep = 0;
          foreach ($totalSep as $totalS) {
            if ($totalS->tipo_id == 1) {
              $sumSep = $totalS->total + $sumSep;
            }
          }

          $sumOct = 0;
          foreach ($totalOct as $totalO) {
            if ($totalO->tipo_id == 1) {
              $sumOct = $totalO->total + $sumOct;
            }
          }

          $sumNov = 0;
          foreach ($totalNov as $totalN) {
            if ($totalN->tipo_id == 1) {
              $sumNov = $totalN->total + $sumNov;
            }
          }

          $sumDic = 0;
          foreach ($totalDic as $totalD) {
            if ($totalD->tipo_id == 1) {
              $sumDic = $totalD->total + $sumDic;
            }
          }
          $anios = DB::table('salidas')
            ->selectRaw('distinct(year(fecha_emision)) as fecha')
            ->orderByDesc('fecha_emision')
            ->get()->toArray();

          $anio = $request->fecha;
          return view('salidas.reporteVentas', compact('sumEne', 'sumFeb', 'sumMar', 'sumAbr', 'sumMay', 'sumJun', 'sumJul', 'sumAgo', 'sumSep', 'sumOct', 'sumNov', 'sumDic', 'anios', 'anio'));
          break;
        }
    }
  }
}
