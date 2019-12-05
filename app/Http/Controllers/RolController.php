<?php

namespace App\Http\Controllers;

use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
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
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permisos = Permission::orderBy('slug')->get();
        return view('roles.create_rol',compact('permisos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rol = Role::create($request->all());
        $rol->permissions()->sync($request->get('permission'));
        return redirect()->route('roles.index')->with('success','Rol añadido con exito');
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
        $rol = Role::find($id);
        $permisos = Permission::orderBy('slug')->get();
        $slugs=[];
        foreach($rol->permissions->toArray() as $permiso){
            $slugs[] = $permiso['slug'];
        }
        return view('roles.show_rol',compact('rol','permisos','slugs'));
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
        $rol = Role::find($id);
        $permisos = Permission::orderBy('slug')->get();
        $slugs = [];
        foreach($rol->permissions->toArray() as $permiso){
            $slugs[] = $permiso['slug'];
        }
        return view('roles.edit_rol',compact('rol','permisos','slugs'));
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
        $rol = Role::find($id);
        $rol->update($request->all());
        $rol->permissions()->sync($request->get('permission'));
        return redirect()->route('roles.index')->with('success','Rol modificado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rol = Role::find($id);
        if($rol->id != 1 && $rol->id != 2 ){
            $rol->delete();
            return back()->with('success','Rol Eliminado con exito');  
        }else{
            return redirect()->route('roles.index')->with('danger','Este rol no esta disponible');
        }
    }
}
