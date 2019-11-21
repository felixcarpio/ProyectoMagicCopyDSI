<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tipo;

class TipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipos = Tipo::all();
        return view('salidas.tipos')->with('tipos', $tipos);
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
        $this->validate($request, [
            'nombre' => 'required',
            'descripcion' => 'required',
        ]);

        $tipo = new Tipo;
        $tipo->nombre = $request->input('nombre');
        $tipo->descripcion = $request->input('descripcion');

        $tipo->save();

        return redirect('tipo')->with('success', 'El Tipo de Salida se guardó exitosamente');
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
            'descripcion' => 'required',
        ]);

        $tipo = Tipo::find($id);

        $tipo->nombre = $request->input('nombre');    
        $tipo->descripcion = $request->input('descripcion');  
        $tipo->save(); 

        return redirect('tipo')->with('success', 'El Tipo de Salida se actualizó exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //FALTA VERIFICACION DE SI HAY COMPRAS ASOCIADAS. EJEMPLO EN MARCACONTROLLER

        $tipo = Tipo::find($id);
        $tipo->delete();

        return redirect('tipo')->with('success', 'Tipo de Salida eliminada');
    }
}
