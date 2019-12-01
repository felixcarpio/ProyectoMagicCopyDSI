<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pedido;
use App\Producto;
use Illuminate\Support\Facades\DB;

class InventarioController extends Controller
{
  public function array_sort($array, $on, $order=SORT_ASC){

    $new_array = array();
    $sortable_array = array();

    if (count($array) > 0) {
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $k2 => $v2) {
                    if ($k2 == $on) {
                        $sortable_array[$k] = $v2;
                    }
                }
            } else {
                $sortable_array[$k] = $v;
            }
        }

        switch ($order) {
            case SORT_ASC:
                asort($sortable_array);
                break;
            case SORT_DESC:
                arsort($sortable_array);
                break;
        }

        foreach ($sortable_array as $k => $v) {
            $new_array[$k] = $array[$k];
        }
    }

    return $new_array;
}

  public function index()
  {
    $pedidos = DB::table('pedido_producto')
    ->join('productos', 'pedido_producto.producto_id', 'productos.id')
    ->whereRaw('fecha_recibido is not null')
    ->select('pedido_producto.fecha_recibido as fecha', 'pedido_producto.cantidad_ordenada as cantidad', 'productos.nombre as nombre', 'pedido_producto.existencias as existencias', 'pedido_producto.costo_unitario as costo')
    ->get()->toArray();
    $salidas = DB::table('detalles')
    ->join('salidas', 'salidas.id','detalles.salida_id')
    ->join('pedido_producto', 'pedido_producto.id', 'detalles.pedido_producto_id')
    ->join('productos', 'pedido_producto.producto_id', 'productos.id')
    ->select('pedido_producto.costo_unitario as costo','salidas.fecha_emision as fecha', 'productos.nombre as nombre', 'detalles.cantidad_vendida as cantidad', 'detalles.existencias', 'salidas.created_at as fechaCreacion')
    ->whereRaw('detalles.cantidad_vendida <> 0')
    ->get()->toArray();
    $datos = array_merge($pedidos, $salidas);
    $inventario = self::array_sort($datos, 'fechaCreacion', SORT_DESC);
    // dd($inventario);
    return view('inventarios.inventario', compact('inventario'));
  }

  public function getPedidosDelProducto(Request $request){
    $producto = $request->get('producto');

    $pedidos = DB::table('productos')
    ->join('pedido_producto','productos.id','pedido_producto.producto_id')
    ->join('pedidos','pedidos.id','pedido_producto.pedido_id')
    ->select('pedidos.fecha_solicitud','pedidos.codigo','pedido_producto.cantidad_ordenada',
    'pedido_producto.costo_unitario','pedido_producto.fecha_recibido','productos.id','pedido_producto.existencias')
    ->where('pedido_producto.producto_id',$producto)
    ->orderBy('pedidos.fecha_solicitud','desc')
    // ->orderBy('pedido_producto.fecha_recibido','desc')
    ->orderBy('pedidos.codigo','desc')
    ->get();

    //        SELECT * FROM `productos`
    // join `pedido_producto` on `productos`.`id` = `pedido_producto`.`producto_id`
    // join `pedidos` on `pedidos`.`id` = `pedido_producto`.`pedido_id`
    // WHERE `pedido_producto`.`pedido_id` = 1
    // ORDER BY `pedidos`.`fecha_solicitud` DESC

    return response()->json(array('pedidos'=>$pedidos),200);
  }
}
