<?php

namespace App\Http\Controllers;

use App\Rol;
use Illuminate\Http\Request;
use Session;
class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Rol = Rol::all();
        return view('roles.index',compact('Rol'));
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
        $request->validate([
          'nombre' => 'required',
          'descripcion' => 'required'
        ]);

        $Rol = new Rol;
        $Rol->nombre = $request->nombre;
        $Rol->descripcion = $request->descripcion;
        $Rol->save();

        return redirect()->route('roles.index')->with('success','El Rol se ingresó correctamente');
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
          'descripcion' => 'required'
        ]);

        $rol = Rol::find($id);
        $rol->nombre = $request->nombre;
        $rol->descripcion = $request->descripcion;
        $rol->save();
        return redirect('roles')->with('success','El Rol se actualizó correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rol = Rol::find($id);
        $rol->delete();

        return redirect('roles')->with('success','Rol Eliminado');
    }
}
