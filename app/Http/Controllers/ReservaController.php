<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Reserva;
use App\EstadoReserva;
use App\Producto;
use Illuminate\Http\Request;
use PDF;
use Carbon\Carbon;
use Mail;
use Session;
use Redirect;

class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $reservas = Reserva::all();
      $estados = EstadoReserva::all();
      return view('reservas.verReservas', compact('reservas', 'estados'));
    }
    public function reservaCategoria()
    {
        $productos = Producto::all();

        return view('reservas.categoria' , compact('productos'));
    }

    public function reservaCategoriaUnica($tipoProducto)
    {
      $productos = DB::table('productos')
      ->select('productos.id','productos.imagen', 'productos.nombre', 'productos.precio', 'productos.precio_con_descuento', 'productos.existencias', 'productos.existencias', 'productos.descripcion')
      ->where('productos.categorias_id', $tipoProducto)
      ->get()->toArray();

        return view('reservas.categoriaUnica' , compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reservas.reservaConfirmacion');
    }
    public function reservaPDF()
    {
        return view('reservas.pdf');
    }
    public function generatePDF58()
    {
      $ultimo = DB::table('reservas')
      ->select('reservas.codigo_reserva')
      ->orderBy('id', 'desc')
      ->limit(1)
      ->get()->toArray();

      $reservaProductos = DB::table('productos')
      ->join('producto_reserva','productos.id','producto_reserva.producto_id')
      ->join('reservas', 'producto_reserva.reserva_id', 'reservas.id')
      ->select('productos.imagen', 'productos.nombre', 'productos.precio','productos.precio_con_descuento', 'producto_reserva.cantidad_ordenada','producto_reserva.sub_total')
      ->where('reservas.codigo_reserva', $ultimo[0]->codigo_reserva)
      ->get()->toArray();


      $reservas = DB::table('reservas')
      ->select('reservas.precio_sin_descuento','reservas.nombre', 'reservas.correo_comprador')
      ->where('reservas.codigo_reserva', $ultimo[0]->codigo_reserva)
      ->get()->toArray();

        $data = ['title' => 'Reserva'];
        $pdf = PDF::loadView('reservas.pdf', compact('reservaProductos'), compact('reservas'));

        $productos = Producto::all();

        Mail::send(['reservas.categoria'=>'mail'], $productos->all(), function($message) {
          $message->to('orellanadennis12@gmail.com', 'Tutorials Point')->subject
             ('Nueva Reserva Recibida');
          $message->from('orellanadennis12@gmail.com','MAGIC COPY');
       });

        // dd($data);
        return $pdf->download('reserva.pdf');
    }
    public function datosPDF()
    {

      $ultimo = DB::table('reservas')
      ->select('reservas.codigo_reserva')
      ->orderBy('id', 'desc')
      ->limit(1)
      ->get()->toArray();

      $reservaProductos = DB::table('productos')
      ->join('producto_reserva','productos.id','producto_reserva.producto_id')
      ->join('reservas', 'producto_reserva.reserva_id', 'reservas.id')
      ->select('productos.imagen', 'productos.nombre', 'productos.precio','productos.precio_con_descuento', 'producto_reserva.cantidad_ordenada','producto_reserva.sub_total')
      ->where('reservas.codigo_reserva', $ultimo[0]->codigo_reserva)
      ->get()->toArray();

      $reservas = DB::table('reservas')
      ->select('reservas.precio_sin_descuento', 'reservas.nombre', 'reservas.correo_comprador')
      ->where('reservas.codigo_reserva', $ultimo[0]->codigo_reserva)
      ->get()->toArray();


      return view('reservas.pdf', compact('reservaProductos','reservas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // dd($request);
      $this->validate($request,[
        // 'codigo'=>'required',
        'inputTotal'=>'required'
      ]);

      $ReservasNormales = DB::table('reservas')
      ->select('reservas.codigo_reserva')
      ->get();
      $ReservasNormal = DB::table('reservas')
      ->select('reservas.codigo_reserva')
      ->get();

      $codigoReserva = 100000;
      $diferente = False;

        while($diferente == False){
          if ($codigoReserva == 100000) {
            $diferente = True;
          }
          foreach ($ReservasNormales as $reserva) {
            while ($reserva->codigo_reserva == $codigoReserva) {
              $codigoC = 1;
              $codigo1 = mt_rand(0,9);
              $codigo2 = mt_rand(0,9);
              $codigo3 = mt_rand(0,9);
              $codigo4 = mt_rand(0,9);
              $codigo5 = mt_rand(0,9);
              $codigoReserva = $codigoC."".$codigo1."".$codigo2."".$codigo3."".$codigo4."".$codigo5;
              $diferente = True;
            }
          }
          foreach ($ReservasNormal as $reserva) {
            if($reserva->codigo_reserva == $codigoReserva) {
              $diferente = False;
            }
          }
        }


      $reserva = new Reserva;
      $reserva->codigo_reserva = $codigoReserva;
      $reserva->precio_sin_descuento = $request->input('inputTotal');
      $reserva->telefono_reserva = 12345678;
      $reserva->nombre = $request->input('nombre');
      $reserva->correo_comprador= $request->input('correo');
      $reserva->estado_reserva_id = 1;
      $reserva->fecha_solicitud = Carbon::now();
      $reserva->save();

      $reserva_producto =  new Reserva;
      if(count($request->cantidadInput)>0){
        foreach ($request->productoInput as $iteracion => $v) {
          $datos = array(
            $request->productoInput[$iteracion] => [
              'reserva_id' =>$reserva->id,
              'cantidad_ordenada'=>$request->cantidadInput[$iteracion],
              'sub_total'=>$request->subtotalInput[$iteracion],
              ]
          );
          $reserva->productos()->attach($datos);
        }
      }

      // Mail::send('reservas.pdf',$request->all(), function($msj){
      //     $msj->subject('Ha recibido una nueva cotizacion');
      //     $msj->to('orellanadennis12@gmail.com');
      // });

      // self::datosPDF($codigoReserva);
      // self::generatePDF58();
      return redirect('/reserva/pdf/ver');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $reserva = Reserva::find($id);
      $estados = EstadoReserva::all();
      return view('reservas.verReserva', compact('reserva', 'estados'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $reserva = Reserva::find($id);


      $reserva->estado_reserva_id = $request->input('estados_id');
      $reserva->fecha_reclamo = Carbon::now();

      $reserva->save();

      return redirect('reservas')->with('success', 'Estado de reserva actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $reserva = Reserva::find($id);

      $reserva->delete();

      return redirect('reservas')->with('success', 'Reserva Eliminada');
    }

    public function datosPDFReserva($id)
    {
      $reservaProductos = DB::table('productos')
      ->join('producto_reserva','productos.id','producto_reserva.producto_id')
      ->join('reservas', 'producto_reserva.reserva_id', 'reservas.id')
      ->select('productos.imagen', 'productos.nombre', 'productos.precio','productos.precio_con_descuento', 'producto_reserva.cantidad_ordenada','producto_reserva.sub_total')
      ->where('reservas.codigo_reserva', $id)
      ->get()->toArray();

      $reservas = DB::table('reservas')
      ->select('reservas.codigo_reserva','reservas.precio_sin_descuento', 'reservas.nombre', 'reservas.correo_comprador')
      ->where('reservas.codigo_reserva', $id)
      ->get()->toArray();

      return view('reservas.pdfPorReserva', compact('reservaProductos','reservas'));
    }

    public function generatePDF58Reserva($id)
    {
      $reservaProductos = DB::table('productos')
      ->join('producto_reserva','productos.id','producto_reserva.producto_id')
      ->join('reservas', 'producto_reserva.reserva_id', 'reservas.id')
      ->select('productos.imagen', 'productos.nombre', 'productos.precio','productos.precio_con_descuento', 'producto_reserva.cantidad_ordenada','producto_reserva.sub_total')
      ->where('reservas.codigo_reserva', $id)
      ->get()->toArray();


      $reservas = DB::table('reservas')
      ->select('reservas.precio_sin_descuento','reservas.nombre', 'reservas.correo_comprador')
      ->where('reservas.codigo_reserva', $id)
      ->get()->toArray();

        $data = ['title' => 'Reserva'];
        $pdf = PDF::loadView('reservas.pdf', compact('reservaProductos'), compact('reservas'));
        return $pdf->download('reserva'. $id . '.pdf');
    }
}
