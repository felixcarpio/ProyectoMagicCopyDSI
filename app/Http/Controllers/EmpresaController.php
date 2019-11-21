<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Empresa;
use Storage;
use Session;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $empresa = Empresa::all();
        return view('contactos.empresa',compact('empresa'))->with('empresa',$empresa);
    
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
        //
        $this->validate($request,[
            'nombre' => 'required',           
            'nit' =>'required|regex:/^[0-9]{4}-[0-9]{6}-[0-9]{3}-[0-9]{1}$/',                      
            'registro' =>'required|regex:/^[0-9]{5}-[0-9]{1}$/',
            'giro' =>'required',  
            'direccion' => 'required',
            'correo' => 'required',
          ]);
  
          $empresa = new Empresa;
  
          $empresa->nombre = $request->input('nombre');
          $empresa->nit = $request->input('nit');
          $empresa->registro = $request->input('registro');
          $empresa->giro = $request->input('giro');
          $empresa->direccion = $request->input('direccion');
          $empresa->correo = $request->input('correo');
  
  
          $empresa->save();  

          return redirect('empresa')->with('success', 'La nueva Empresa se guardó exitosamente');
    
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
        $this->validate($request,[
            'nombre' => 'required',           
            'nit' =>'required|regex:/^[0-9]{4}-[0-9]{6}-[0-9]{3}-[0-9]{1}$/',                      
            'registro' =>'required|regex:/^[0-9]{5}-[0-9]{1}$/',
            'giro' =>'required',   
            'direccion' => 'required',
            'correo' => 'required',
          ]);
          $empresa = Empresa::find($id);
    
          $empresa->nombre = $request->input('nombre');
          $empresa->nit = $request->input('nit');
          $empresa->registro = $request->input('registro');
          $empresa->giro = $request->input('giro');
          $empresa->direccion = $request->input('direccion');
          $empresa->correo = $request->input('correo');
    
          $empresa->save();
          return redirect('empresa')->with('success', 'La Empresa se actualizó exitosamente');
           
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
