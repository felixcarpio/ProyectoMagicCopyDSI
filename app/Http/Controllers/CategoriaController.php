<?php

namespace App\Http\Controllers;
use App\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = Categoria::all();
        return view('categorias.categoria',compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Categoria.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
        [
            'nombre' => 'required',
            'descripcion' => 'required'
        ]);
        
        $categoria = new Categoria;

        $categoria->nombre = $request->input(('nombre'));
        $categoria->descripcion = $request->input(('descripcion'));
        $categoria->save();

        return redirect()->route('categoria.index')->with('success','La categoria se a guardado');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categorias=Categoria::find($id);
        return view('categoria.show',compact('categorias'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categorias=categoria::find($id);
        return view('categoria.edit',compact('categorias'));
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
        'descripcion' => 'required'
        ]);

        $categoria = Categoria::find($id);

    $categoria->nombre = $request->input('nombre');
    $categoria->descripcion = $request->input('descripcion');
    $categoria->save();

        //categoria::find($id)->update($request->all());
        return redirect()->route('categoria.index')->with('success','La categoria se actualizo exitosamente');
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
