<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Evento;
use App\Clasificacion;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $clasificaciones = Clasificacion::all();

      return view('eventos.index', compact('clasificaciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('eventos.index');
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
        'fechaEvento' => 'required',
        'cantidadPersonas' => 'required',
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
        $path = $request->file('imagen')->move(public_path().'/images/cotizacionesEventos/', $nombreDeArchivoAlmacenar);   // public/storage  storage/app/public
      }
      else {
        $nombreDeArchivoAlmacenar = 'noimage.jpg';
      }

      $eventosNormales = DB::table('eventos')
      ->select('eventos.codigo')
      ->get();
      $eventosNormal = DB::table('eventos')
      ->select('eventos.codigo')
      ->get();

      $codigoEvento = 200000;
      $diferente = False;

        while($diferente == False){
          if ($codigoEvento == 200000) {
            $diferente = True;
          }
          foreach ($eventosNormales as $eventos) {
            while ($eventos->codigo == $codigoEvento) {
              $codigoC = 2;
              $codigo1 = mt_rand(0,9);
              $codigo2 = mt_rand(0,9);
              $codigo3 = mt_rand(0,9);
              $codigo4 = mt_rand(0,9);
              $codigo5 = mt_rand(0,9);
              $codigoEvento = $codigoC."".$codigo1."".$codigo2."".$codigo3."".$codigo4."".$codigo5;
              $diferente = True;
            }
          }
          foreach ($eventosNormal as $evento) {
            if($evento->codigo == $codigoEvento) {
              $diferente = False;
            }
          }
        }




      $evento = new Evento;

      $evento->nombre_cliente = $request->input('nombre');
      $evento->codigo = $codigoEvento;
      $evento->correo = $request->input('correo');
      $evento->num_telefono = $request->input('telefono');
      $evento->descripcion = $request->input('descripcion');
      $evento->cantidad_personas = $request->input('cantidadPersonas');
      $evento->fecha_evento = $request->input('fechaEvento');
      $evento->tema = $request->input('tema');
      $evento->tarjetas = $request->input('tarjeta');
      $evento->mesa_boquitas = $request->input('boquita');
      $evento->centros_mesa = $request->input('centroMesa');
      $evento->arco_entrada = $request->input('arco');
      $evento->recuerdos = $request->input('recuerdo');
      $evento->comida = $request->input('comida');
      $evento->lugar = $request->input('lugar');
      $evento->codigo_clasificacion= $request->input('clasificacion_id');
      $evento->imagen = $nombreDeArchivoAlmacenar;
      $evento->save();

      return redirect('evento')->with('success', 'La cotizacion fue enviada exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function destroy($id)
    {
        //
    }
}
