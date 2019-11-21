<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $marca = Marca::all();

    return view('productos.marca',compact('marca'));
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

    $marca = new Marca;

    $marca->nombre = $request->input('nombre');

    $marca->save();

    return redirect('marca')->with('success', 'La Marca se guardó exitosamente');
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
    $this->validate($request,[
      'nombre' => 'required',
    ]);
    $marca = Marca::find($id);

    $marca->nombre = $request->input('nombre');

    $marca->save();

    return redirect('marca')->with('success', 'La marca se actualizo exitosamente');
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    $productoMarcas = DB::table('productos')
    ->select('productos.marcas_id')
    ->where('productos.marcas_id', $id)
    ->get()->toArray();

    $Marcas = DB::table('marcas')
    ->select('marcas.id')
    ->where('marcas.id', $id)
    ->get();

    if (empty($productoMarcas)){
      $marca = Marca::find($id);
      $marca->delete();
      return back()->with('success', 'Marca Eliminada1');
    }else{
      $cuento = 0;
      foreach ($productoMarcas as $productoMarca){
        foreach ($Marcas as $marca){
          if($productoMarca->marcas_id == $marca->id ){
            return back()->with('success', 'No se puede eliminar la marca, ya que posee productos asociados');
          }else{
            $marca = Marca::find($id);
            $marca->delete();
            return redirect('marca')->with('success', 'Marca Eliminada2');
          }
        }
      }
    }
  }
}
