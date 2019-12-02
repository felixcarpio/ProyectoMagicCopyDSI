<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proveedor;
use App\Producto;
use App\Pedido;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PedidoController extends Controller
{
  public function mostrarPedidos(){
    $pedidos = DB::table('pedidos')
    ->join('pedido_producto', 'pedido_producto.pedido_id', 'pedidos.id')
    ->select('pedidos.id', 'pedidos.codigo', 'pedidos.fecha_solicitud', 'pedido_producto.fecha_recibido')
    ->distinct('pedidos.id')
    ->orderBy('fecha_solicitud', 'desc')
    ->orderBy('codigo', 'desc')
    ->get();

    return view('inventarios.verPedidos', compact('pedidos'));
  }

  public function index(){
    $proveedores = Proveedor::all();
    $productos = Producto::all();
    $cantPe = DB::table('pedidos')
    ->select('id')
    ->orderBy('id', 'desc')
    ->first();

    !$cantPe ? $pedido = 1 : $pedido = $cantPe->id+1;

    return view('inventarios.pedido')->with('proveedores',$proveedores)
    ->with('productos',$productos)->with('pedido',$pedido);
  }

  public function getProductosProveedor(Request $request){
    $proveedor = $request->get('proveedor');

    $productos = DB::table('productos')
    ->join('producto_proveedor', 'productos.id', 'producto_proveedor.producto_id')
    ->join('proveedores', 'proveedores.id', 'producto_proveedor.proveedor_id')
    ->select('productos.id', 'productos.nombre')
    ->groupBy('productos.id','productos.nombre')
    ->where('proveedores.id', $proveedor )
    ->get();

    return response()->json(array('productos'=>$productos), 200);
  }


  public function validarFechaMayorDeHoy($fechaIngresada){
    $fechaMayor = False;
    $hoy = Carbon::today('America/El_Salvador');

    $stringFecha = explode("/",$fechaIngresada);
    $diaIngresado = (int) $stringFecha[0];
    $mesIngresado = (int) $stringFecha[1];
    $anioIngresado = (int) $stringFecha[2];

    $fechaIngresada = Carbon::create($anioIngresado, $mesIngresado, $diaIngresado, 0, 0, 0);

    if($fechaIngresada->greaterThan($hoy)){
      $fechaMayor = True;
    }

    return $fechaMayor;
  }

  public function store(Request $request){
    // dd($request);
    $this->validate($request,[
      'fecha_solicitud'=>'required',
      'proveedor'=>'required',
    ]);

    $pedido = new Pedido;

    $cantidadPedidos = DB::table('pedidos')
    ->select('id')
    ->orderBy('id', 'desc')
    ->first();

    !$cantidadPedidos ? $codigoP = 1 : $codigoP = $cantidadPedidos->id+1;
    $codigo = (string) $codigoP;

    $pedido->codigo = $codigo;

    // validacion fecha
    $fechaMayor = self::validarFechaMayorDeHoy($request->fecha_solicitud);

    if($fechaMayor){ 
      return redirect('verpedidos')->with('error','No es posible ingresar una fecha mayor a la del dia de hoy');
    }

    $pedido->fecha_solicitud = $request->input('fecha_solicitud');
    $pedido->proveedor = $request->input('proveedor');

    $pedido->save();

    $pedido_producto = new Pedido;
    if(count($request->cantidad)>0){
      foreach($request->producto as $iteracion=>$v){
        $datos = array(
          $request->producto[$iteracion] => [
            'pedido_id'=>$pedido->id,
            'cantidad_ordenada'=>$request->cantidad[$iteracion],
            ]
          );
          $pedido->productos()->attach($datos);
        }
      }

      return redirect('verpedidos')->with('success', 'El Pedido se guardó exitosamente');

    }

    public function show($id){
      $pedido = DB::table('pedidos')
      ->join('pedido_producto', 'pedidos.id', 'pedido_producto.pedido_id')
      ->join('productos', 'productos.id', 'pedido_producto.producto_id')
      ->select('pedidos.codigo', 'pedidos.fecha_solicitud', 'pedido_producto.fecha_recibido', 'productos.nombre', 'pedido_producto.costo_unitario', 'pedido_producto.cantidad_ordenada', 'pedidos.proveedor', 'pedido_producto.pedido_id')
      ->where('pedidos.id', $id)
      ->get();
      
      $proveedor = DB::table('proveedores')
      ->select('nombre')
      ->where('proveedores.id', $pedido[0]->proveedor)
      ->get();

      return view('inventarios.show', compact('pedido', 'proveedor'));
    }

    public function edit($id){
      $pedido = DB::table('pedidos')
      ->join('pedido_producto', 'pedidos.id', 'pedido_producto.pedido_id')
      ->join('productos', 'productos.id', 'pedido_producto.producto_id')
      ->where('pedidos.id', $id)
      ->get();

      return view('inventarios.editar', compact('pedido'));
    }

    public function destroy($id){
      $pedido = Pedido::find($id);
      $pedido->delete();
      return redirect('verpedidos')->with('success', 'Pedido eliminado');
    }

  }
