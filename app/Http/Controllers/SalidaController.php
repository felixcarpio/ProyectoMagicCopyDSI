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

class SalidaController extends Controller
{
  public function verSalidas(){
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

  public function nuevaSalida($tipoRequest, $fechaEmision, $total, $comentario)
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
    $detalle->existencias = $existencias -1;
    $detalle->save();
  }

  public function store(Request $request)
  {
    $salida = self::nuevaSalida($request->tipo, $request->fecha_emision, $request->total, $request->comentario);

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
          self::actualizarDatosDetalle($detalle, $request->precio[$i], $cantidad, $pedido_producto->id, $existencias+1);
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
            self::actualizarDatosDetalle($detalle, $request->precio[$i], $cantidad, $pedido_producto->id, $existencias+1);
          }
        }
      }
    }

    return redirect('/salida')->with('success', 'Se ha registrado la salida');
  }

  public function nuevaSalidaVenta($tipoRequest, $fechaEmision, $total, $promocion, $correlativo_factura, $tipo_factura, $cantidad_promociones)
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

  public function storeVenta(Request $request)
  {
    // dd($request);
    $salida = self::nuevaSalidaVenta($request->tipo, $request->fecha_emision, $request->total, $request->promocion, $request->correlativo_factura, $request->factura, $request->cantidad_promociones);
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
    return redirect('/salida/venta')->with('success', 'Se ha registrado la salida');
  }

  public function show(){
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
}
