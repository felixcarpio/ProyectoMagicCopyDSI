<?php

namespace App\Http\Controllers;
use App\ImagenEvento;
use Illuminate\Http\Request;
use Storage;

class ImagenEventoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $imagenesevento = ImagenEvento::all();

        return view('eventos.eventos')->with('imagenesevento',$imagenesevento);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $path = $request->file('imagen')->move(public_path().'/images/imageneseventos/', $nombreDeArchivoAlmacenar);   // public/storage  storage/app/public
      }
      else {
        $nombreDeArchivoAlmacenar = 'noimage.jpg';
      }

      $imagenEvento = new ImagenEvento;
      $imagenEvento->nombre = $request->input('nombre');
      $imagenEvento->imagen = $nombreDeArchivoAlmacenar;
    
      $imagenEvento->save();

      return redirect('imagenes_evento')->with('success', 'El nuevo Evento se guardó exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       


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
        $this->validate($request,[
            'nombre' => 'required',
          ]);

          if($request->hasFile('imagen')){
            $nombreDeArchivoConExt = $request->file('imagen')->getClientOriginalName();
            $nombreDeArchivo = pathinfo($nombreDeArchivoConExt, PATHINFO_FILENAME);
            $extension = $request->file('imagen')->getClientOriginalExtension();
            $nombreDeArchivoAlmacenar = $nombreDeArchivo.' '.time().'.'.$extension;
            $path = $request->file('imagen')->move(public_path().'/images/imageneseventos/', $nombreDeArchivoAlmacenar);
        }

        $imagenEvento = ImagenEvento::find($id);
        $imagenEvento->nombre = $request->input('nombre');
        if($request->hasFile('imagen')){
            Storage::delete('MagicCopy/public/images/imageneseventos/' . $imagenEvento->imagen);
            $imagenEvento->imagen = $nombreDeArchivoAlmacenar;
          }

          $imagenEvento->save();

          return redirect('imagenes_evento')->with('success', 'El evento se actualizó exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $imagenEvento = ImagenEvento::find($id);
        if($imagenEvento->imagen != 'noimage.jpg'){
           //Delete image
           Storage::delete('MagicCopy/public/images/imageneseventos/' . $imagenEvento->imagen);
         }
        $imagenEvento->delete();
  
        return redirect('imagenes_evento')->with('success', 'Evento Eliminado');
    }
}
