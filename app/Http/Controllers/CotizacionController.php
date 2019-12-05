<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Cotizacion;
use App\Evento;
use App\Clasificacion;
use Illuminate\Http\Request;

class CotizacionController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {

    $cotizaciones = Cotizacion::all();
    $eventos = Evento::all();
    return view('cotizaciones.verCotizaciones', compact('cotizaciones', 'eventos'));

  }


  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    return view('cotizaciones.crearCotizacion');
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {
    $this->validate($request,[
      'nombre' => 'required',
      'correo' => 'required',
      'telefono' => 'required',
      'descripcion' => 'required',
    ]);

    //Manejo de imagenes
    if($request->hasFile('imagen')){
      // Obtiene el nombre de la imagen junto a su extension
      $nombreDeArchivoConExt = $request->file('imagen')->getClientOriginalName();
      // Obtiene el nombre de la imagen (sin su extension)
      $nombreDeArchivo = pathinfo($nombreDeArchivoConExt, PATHINFO_FILENAME);
      // Obtiene solo la extension de la imagen
      $extension = $request->file('imagen')->getClientOriginalExtension();
      // Nombre con el que se guardara la imagen: nombreImagen+Fecha+.extension
      $nombreDeArchivoAlmacenar = $nombreDeArchivo.'_'.time().'.'.$extension; //concatenates with timestamp
      // Subida de la imagen
      $path = $request->file('imagen')->move(public_path().'/images/cotizaciones/', $nombreDeArchivoAlmacenar);   // public/storage  storage/app/public
    }
    else {
      $nombreDeArchivoAlmacenar = 'noimage.jpg';
    }

    $cotizacionesNormales = DB::table('cotizaciones')
    ->select('cotizaciones.codigo')
    ->get();
    $cotizacionesNormal = DB::table('cotizaciones')
    ->select('cotizaciones.codigo')
    ->get();

    $codigoCotz = 11;
    $diferente = False;

      while($diferente == False){
        if ($codigoCotz == 11) {
          $diferente = True;
        }
        foreach ($cotizacionesNormales as $cotizaciones) {
          while ($cotizaciones->codigo == $codigoCotz) {
            $codigoC = 1;
            $codigo1 = mt_rand(0,9);
            $codigo2 = mt_rand(0,9);
            $codigo3 = mt_rand(0,9);
            $codigo4 = mt_rand(0,9);
            $codigo5 = mt_rand(0,9);
            $codigoCotz = $codigoC."".$codigo1."".$codigo2."".$codigo3."".$codigo4."".$codigo5;
            $diferente = True;
          }
        }
        foreach ($cotizacionesNormal as $cotizacione) {
          if($cotizacione->codigo == $codigoCotz) {
            $diferente = False;
          }
        }
      }




    $cotizacion = new Cotizacion;

    $cotizacion->nombre_contacto = $request->input('nombre');
    $cotizacion->codigo = $codigoCotz;
    $cotizacion->correo_contacto = $request->input('correo');
    $cotizacion->telefono = $request->input('telefono');
    $cotizacion->descripcion_producto = $request->input('descripcion');
    $cotizacion->imagen = $nombreDeArchivoAlmacenar;
    $cotizacion->save();

    return redirect('libreria')->with('success', 'La cotizacion fue enviada exitosamente');
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($codigo)
  {
    $cotizacionesNormales = DB::table('cotizaciones')
    ->select('cotizaciones.id','cotizaciones.codigo','cotizaciones.fecha_solicitud','cotizaciones.descripcion_producto', 'cotizaciones.imagen', 'cotizaciones.nombre_contacto', 'cotizaciones.correo_contacto','cotizaciones.telefono')
    ->get();

    $cotizacionesEventos = DB::table('eventos')
    ->select('eventos.id','eventos.codigo', 'eventos.cantidad_personas', 'eventos.fecha_evento', 'eventos.lugar', 'eventos.tema', 'eventos.tarjetas','eventos.centros_mesa', 'eventos.arco_entrada', 'eventos.recuerdos', 'eventos.comida', 'eventos.imagen', 'eventos.nombre_cliente', 'eventos.correo', 'eventos.num_telefono')
    ->get();

    foreach ($cotizacionesNormales as $cotizacionNormal) {
      if ($cotizacionNormal->codigo == $codigo) {
        $cotizacion = Cotizacion::find($cotizacionNormal->id);

        return view('cotizaciones.verCotizacion', compact('cotizacion'));
      }
    }

    foreach ($cotizacionesEventos as $cotizacionEvento) {
      if ($cotizacionEvento->codigo == $codigo) {
        $evento = Evento::find($cotizacionEvento->id);
        $clasificaciones =  Clasificacion::all();

        return view('cotizaciones.verEvento', compact('evento','clasificaciones'));
      }
    }

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
    //
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($codigo)
  {

    $cotizacionesNormales = DB::table('cotizaciones')
    ->select('cotizaciones.codigo', 'cotizaciones.id')
    ->get();
    echo "string";
    $cotizacionesEventos = DB::table('eventos')
    ->select('eventos.codigo','eventos.id')
    ->get();
    echo "pase segunda db";
    foreach ($cotizacionesNormales as $cotizacionNormal) {
      if ($cotizacionNormal->codigo == $codigo) {
        $cotizacion = Cotizacion::find($cotizacionNormal->id);

        $cotizacion->delete();

        return redirect('cotizaciones')->with('success', 'Cotizacion Eliminada');
      }
    }

    foreach ($cotizacionesEventos as $cotizacionEvento) {
      if ($cotizacionEvento->codigo == $codigo) {
        $evento = Evento::find($cotizacionEvento->id);
        $evento->delete();

        return redirect('cotizaciones')->with('success', 'Cotizacion Evento Eliminado');
      }
    }

  }
}
