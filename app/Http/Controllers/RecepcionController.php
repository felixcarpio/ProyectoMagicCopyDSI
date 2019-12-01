<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pedido;
use App\Producto;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RecepcionController extends Controller
{
  public function index()
  {
    $pedidos = DB::table('pedido_producto')
    ->select('pedido_id')
    ->whereNull('fecha_recibido')
    ->distinct()
    ->get();

    return view('inventarios.recepcion_pedido')->with('pedidos',$pedidos);
  }

  public function getProductosPedido(Request $request){
    $pedido = $request->get('pedido');

    $productos = DB::table('productos')
    ->join('pedido_producto','productos.id','pedido_producto.producto_id')
    ->join('pedidos','pedidos.id','pedido_producto.pedido_id')
    ->select('productos.id','productos.nombre')
    ->groupBy('productos.id','productos.nombre')
    ->where('pedidos.id',$pedido)
    ->whereNull('pedido_producto.fecha_recibido')
    ->get();

    return response()->json(array('productos'=>$productos), 200);
  }

  public function actualizarExistencias($idProducto, $idPedido){
    $cantidadPedidoActual = DB::table('pedido_producto')
    ->join('productos','productos.id','pedido_producto.producto_id')
    ->select('pedido_producto.pedido_id', 'pedido_producto.cantidad_ordenada','pedido_producto.fecha_recibido')
    ->where('productos.id',$idProducto)
    ->where('pedido_producto.pedido_id', $idPedido)
    ->get()->toArray();
    // dd($cantidadPedidoActual[0]->cantidad_ordenada);
    $cantidad_ordenada = $cantidadPedidoActual[0]->cantidad_ordenada;
    $queryProductos = DB::table('productos')
    ->select('existencias')
    ->where('id', $idProducto)
    ->get()->toArray();
    $existencias = $queryProductos[0]->existencias;
    $producto = Producto::find($idProducto);
    $producto->existencias = $existencias + $cantidad_ordenada;
    $producto->save();
    return $existencias + $cantidad_ordenada;
  }

  // Funciones para validar fechas

  public function validarFechaMayorDeHoy($fechaRecepcion){
    $fechaMayor = False;
    $hoy = Carbon::today('America/El_Salvador');

    $stringFecha = explode("/",$fechaRecepcion);
    $diaIngresado = (int) $stringFecha[0];
    $mesIngresado = (int) $stringFecha[1];
    $anioIngresado = (int) $stringFecha[2];

    $fechaIngresada = Carbon::create($anioIngresado, $mesIngresado, $diaIngresado, 0, 0, 0);

    if($fechaIngresada->greaterThan($hoy)){
      $fechaMayor = True;
    }

    return $fechaMayor;
  }

  public function validarFechaMayorASolicitud($fechaRecepcion, $fechaSolicitud){
    $fechaMayor = False;

    $stringFechaRecepcion = explode("/",$fechaRecepcion);
    $diaFechaRecepcion = (int) $stringFechaRecepcion[0];
    $mesFechaRecepcion = (int) $stringFechaRecepcion[1];
    $anioFechaRecepcion = (int) $stringFechaRecepcion[2];

    $stringFechaSolicitud = explode("-",$fechaSolicitud);
    // dd($stringFechaSolicitud);
    $anioFechaSolicitud = (int) $stringFechaRecepcion[0];
    $mesFechaSolicitud = (int) $stringFechaSolicitud[1];
    $diaFechaSolicitud = (int) $stringFechaSolicitud[2];

    $fechaRecibido = Carbon::create($anioFechaRecepcion, $mesFechaRecepcion, $diaFechaRecepcion, 0, 0, 0);
    $fechaDeSolicitud = Carbon::create($anioFechaSolicitud, $mesFechaSolicitud, $diaFechaSolicitud, 0, 0, 0);

    if($fechaDeSolicitud->greaterThan($fechaRecibido)){
      $fechaMayor = True;
    }

    return $fechaMayor;
  }

  public function formatoCorrectoFecha($fecha){
    $stringFecha = explode("/", $fecha);
    $dia = $stringFecha[0];
    $mes = $stringFecha[1];
    $anio = $stringFecha[2];
    // $fechaNuevoFormato = ""+$anio+"-"+$mes+"-"+$dia+"";
    return "".$anio."-".$mes."-".$dia."";
  }

  // Almacenar recepcion de pedido

  public function store(Request $request)
  {
    // dd($request);
    $this->validate($request,[
      'IdPedido'=>'required',
      'fecha_recibido'=>'required',
    ]);

    $id = $request->input('IdPedido');

    $pedidoRecibido = Pedido::find($id);

    $productos = DB::table('productos')
    ->join('pedido_producto','productos.id','pedido_producto.producto_id')
    ->join('pedidos','pedidos.id','pedido_producto.pedido_id')
    ->select('productos.id','productos.nombre','pedidos.fecha_solicitud')
    ->groupBy('productos.id','productos.nombre','pedidos.fecha_solicitud')
    ->where('pedidos.id',$id)
    ->get()
    ->toArray();

    $productoArray = (array) $productos[0];
    $fechaSolicitud = $productoArray["fecha_solicitud"];

    $fechaMayorAHoy = self::validarFechaMayorDeHoy($request->fecha_recibido);
    $fechaMayorASolicitud = self::validarFechaMayorASolicitud($request->fecha_recibido, $fechaSolicitud);

    if($fechaMayorAHoy){
      return redirect('/recepcion')->with('error', 'No es posible ingresar una fecha mayor a la del dia de hoy');
    }

    if($fechaMayorASolicitud){
      return redirect('/recepcion')->with('error', 'La fecha de recepción debe ser mayor a la fecha de solicitud');
    }

    foreach ($productos as $iteracion => $value) {
      $prod = (array) $productos[$iteracion];
      $idProd = $prod["id"];

      $producto=$pedidoRecibido->productos()
      ->where('pedido_id',$request->IdPedido)
      ->where('producto_id',$idProd)
      ->first();

      if(!is_null($request->costo_unitario[$iteracion])){
        $producto->pivot->costo_unitario = $request->costo_unitario[$iteracion];
        $fecha_recibido = self::formatoCorrectoFecha($request->fecha_recibido);
        $producto->pivot->fecha_recibido = $fecha_recibido;
        $existencias=self::actualizarExistencias($idProd,$id);
        $producto->pivot->existencias = $existencias;
        $producto->pivot->save();
      }
    }

    $pedidoRecibido->comentario = $request->comentario;
    $pedidoRecibido->save();

    return redirect('/verpedidos')->with('success','El Pedido ha sido recibido');
  }
}
