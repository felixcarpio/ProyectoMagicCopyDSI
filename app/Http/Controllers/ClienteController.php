<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Cliente;
use App\Telefono;
use Storage;
use Session;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes.index',compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clientes.create');
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
            'apellido' => 'required',
            'correo' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            
        ]);

        $data = $request->all();
        $lastid = Cliente::create($data)->id;
        //if(count($request->numero) > 0){
          //  foreach($request->numero as $item => $v){
            //    $data2 = array(
              //      'cliente_id' => $lastid,
                //    'numero' => $request->numero[$item]
                //);
                //Telefono::insert($data2);
            //}
        //}
        return redirect()->route('clientes.index')->with('success','El Cliente se ingresó correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cliente = Cliente::find($id);

        return view('clientes.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cliente = Cliente::find($id);

        return view('clientes.edit',compact('cliente'));
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
            'apellido' => 'required',
            'correo' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            ]);

            $cliente = Cliente::find($id);

            $cliente->nombre = $request->input('nombre');
            $cliente->apellido = $request->input('apellido');
            $cliente->correo = $request->input('correo');
            $cliente->dui = $request->input('dui');
            $cliente->direccion = $request->input('direccion');
            $cliente->nombre_empresa = $request->input('nombre_empresa');
            $cliente->giro = $request->input('giro');
            $cliente->nit = $request->input('nit');
            $cliente->registro = $request->input('registro');
            $cliente->telefono = $request->input('telefono');
            $cliente->telefono2 = $request->input('telefono2');

            $cliente->save();

            return redirect()->route('clientes.index')->with('success','El Cliente se modificó correctamente');

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
