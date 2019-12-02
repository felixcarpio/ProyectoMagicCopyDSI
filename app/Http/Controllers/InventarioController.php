<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pedido;
use App\Producto;
use Illuminate\Support\Facades\DB;
use PDF;

class InventarioController extends Controller
{
  public function array_sort($array, $on, $order = SORT_ASC)
  {

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

  public function obtenerInventario()
  {
    $pedidos = DB::table('pedido_producto')
      ->join('productos', 'pedido_producto.producto_id', 'productos.id')
      ->whereRaw('fecha_recibido is not null')
      ->select('pedido_producto.fecha_recibido as fecha', 'pedido_producto.cantidad_ordenada as cantidad', 'productos.nombre as nombre', 'pedido_producto.existencias as existencias', 'pedido_producto.costo_unitario as costo')
      ->get()->toArray();
    $salidas = DB::table('detalles')
      ->join('salidas', 'salidas.id', 'detalles.salida_id')
      ->join('pedido_producto', 'pedido_producto.id', 'detalles.pedido_producto_id')
      ->join('productos', 'pedido_producto.producto_id', 'productos.id')
      ->select('pedido_producto.costo_unitario as costo', 'salidas.fecha_emision as fecha', 'productos.nombre as nombre', 'detalles.cantidad_vendida as cantidad', 'detalles.existencias', 'salidas.created_at as fechaCreacion')
      ->whereRaw('detalles.cantidad_vendida <> 0')
      ->get()->toArray();
    $datos = array_merge($pedidos, $salidas);
    $inventario = self::array_sort($datos, 'fechaCreacion', SORT_DESC);
    return $inventario;
  }

  public function index()
  {
    $productos = DB::table('productos')
      ->orderBy('nombre')
      ->get();
    $inventario = self::obtenerInventario();
    $nombre = "todos los productos";
    return view('inventarios.inventario', compact('inventario', 'productos', 'nombre'));
  }

  public function queryInventarioProducto($producto)
  {
    $pedidos = DB::table('pedido_producto')
      ->join('productos', 'pedido_producto.producto_id', 'productos.id')
      ->where('productos.nombre', $producto)
      ->whereRaw('fecha_recibido is not null')
      ->select('pedido_producto.fecha_recibido as fecha', 'pedido_producto.cantidad_ordenada as cantidad', 'productos.nombre as nombre', 'pedido_producto.existencias as existencias', 'pedido_producto.costo_unitario as costo')
      ->get()->toArray();
    $salidas = DB::table('detalles')
      ->join('salidas', 'salidas.id', 'detalles.salida_id')
      ->join('pedido_producto', 'pedido_producto.id', 'detalles.pedido_producto_id')
      ->join('productos', 'pedido_producto.producto_id', 'productos.id')
      ->select('pedido_producto.costo_unitario as costo', 'salidas.fecha_emision as fecha', 'productos.nombre as nombre', 'detalles.cantidad_vendida as cantidad', 'detalles.existencias', 'salidas.created_at as fechaCreacion')
      ->where('productos.nombre', $producto)
      ->whereRaw('detalles.cantidad_vendida <> 0')
      ->get()->toArray();
    $datos = array_merge($pedidos, $salidas);
    $inventario = self::array_sort($datos, 'fechaCreacion', SORT_DESC);
    return $inventario;
  }

  public function inventarioDelProducto(Request $request)
  {
    $productos = DB::table('productos')
      ->orderBy('nombre')
      ->get();
    $inventario = self::queryInventarioProducto($request->producto);
    $nombre = $request->producto;
    return view('inventarios.inventario', compact('inventario', 'productos', 'nombre'));
  }

  public function indexReporte()
  {
    $productos = DB::table('productos')
      ->select('nombre')
      ->orderBy('nombre')
      ->get();
    $anios = DB::table('salidas')
      ->selectRaw('distinct(year(fecha_emision)) as fecha')
      ->orderByDesc('fecha_emision')
      ->get()->toArray();
    return view('inventarios.reporteInventario', compact('productos', 'anios'));
  }

  public function generarReporteInventario(Request $request)
  {
    if (($request->producto == null && $request->fecha == null) || ($request->producto == "Todos los Productos" && $request->fecha == "Todos los años") || ($request->producto == "Todos los Productos" && $request->fecha == null) || ($request->producto == null && $request->fecha == "Todos los años")) {
      $inventario = self::obtenerInventario();
      $producto = "todos los productos";
      $anio = "todos los años";
    } elseif ($request->producto == null || $request->producto == "Todos los Productos") {
      $pedidos = DB::table('pedido_producto')
        ->join('productos', 'pedido_producto.producto_id', 'productos.id')
        ->whereRaw("fecha_recibido is not null and year(pedido_producto.fecha_recibido) = '$request->fecha'")
        ->select('pedido_producto.fecha_recibido as fecha', 'pedido_producto.cantidad_ordenada as cantidad', 'productos.nombre as nombre', 'pedido_producto.existencias as existencias', 'pedido_producto.costo_unitario as costo')
        ->get()->toArray();
      $salidas = DB::table('detalles')
        ->join('salidas', 'salidas.id', 'detalles.salida_id')
        ->join('pedido_producto', 'pedido_producto.id', 'detalles.pedido_producto_id')
        ->join('productos', 'pedido_producto.producto_id', 'productos.id')
        ->select('pedido_producto.costo_unitario as costo', 'salidas.fecha_emision as fecha', 'productos.nombre as nombre', 'detalles.cantidad_vendida as cantidad', 'detalles.existencias', 'salidas.created_at as fechaCreacion')
        ->whereRaw("detalles.cantidad_vendida <> 0 and year(salidas.fecha_emision) = '$request->fecha'")
        ->get()->toArray();
      $datos = array_merge($pedidos, $salidas);
      $inventario = self::array_sort($datos, 'fechaCreacion', SORT_DESC);
      $producto = "todos los productos";
      $anio = $request->fecha;
    } elseif ($request->fecha == null || $request->fecha == "Todos los años") {
      $inventario = self::queryInventarioProducto($request->producto);
      $producto = $request->producto;
      $anio = "todos los años";
    } else {
      $pedidos = DB::table('pedido_producto')
        ->join('productos', 'pedido_producto.producto_id', 'productos.id')
        ->where('productos.nombre', $request->producto)
        ->whereRaw("fecha_recibido is not null and year(pedido_producto.fecha_recibido) = '$request->fecha'")
        ->select('pedido_producto.fecha_recibido as fecha', 'pedido_producto.cantidad_ordenada as cantidad', 'productos.nombre as nombre', 'pedido_producto.existencias as existencias', 'pedido_producto.costo_unitario as costo')
        ->get()->toArray();
      $salidas = DB::table('detalles')
        ->join('salidas', 'salidas.id', 'detalles.salida_id')
        ->join('pedido_producto', 'pedido_producto.id', 'detalles.pedido_producto_id')
        ->join('productos', 'pedido_producto.producto_id', 'productos.id')
        ->select('pedido_producto.costo_unitario as costo', 'salidas.fecha_emision as fecha', 'productos.nombre as nombre', 'detalles.cantidad_vendida as cantidad', 'detalles.existencias', 'salidas.created_at as fechaCreacion')
        ->where('productos.nombre', $request->producto)
        ->whereRaw("detalles.cantidad_vendida <> 0 and year(salidas.fecha_emision) = '$request->fecha'")
        ->get()->toArray();
      $datos = array_merge($pedidos, $salidas);
      $inventario = self::array_sort($datos, 'fechaCreacion', SORT_DESC);
      $producto = $request->producto;
      $anio = $request->fecha;
    }

    $data = [
      'anio' => $anio,
      'producto' => $producto,
      'inventario' => $inventario
    ];

    $pdf = PDF::loadView('inventarios.reporte', $data);
    return $pdf->download('inventario' . $producto . '.pdf');
  }

  public function reporteInventario(Request $request)
  {
    return redirect()->route('reporteInventario', [$request]);
  }
}
