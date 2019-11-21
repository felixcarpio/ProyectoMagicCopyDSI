<?php

namespace App\Http\Controllers;
use App\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $proveedor = Proveedor::all();
      return view('productos.proveedor')->with('proveedor',$proveedor);
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
      // 'direccion' => 'required',
      // 'telefono' => 'required',
        ]);

        $proveedor = new Proveedor;

        $proveedor->nombre = $request->input('nombre');
        $proveedor->direccion = $request->input('direccion');
        $proveedor->telefono = $request->input('telefono');
        $proveedor->save();

        return redirect('proveedor')->with('success', 'El proveedor se guardo exitosamente');
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
      // 'direccion' => 'required',
      // 'telefono' => 'required',
    ]);
    $proveedor = Proveedor::find($id);

    $proveedor->nombre = $request->input('nombre');
    $proveedor->direccion = $request->input('direccion');
    $proveedor->telefono = $request->input('telefono');
    $proveedor->save();

    return redirect('proveedor')->with('success', 'El proveedor se actualizo exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $proveedor = Proveedor::find($id);

      $proveedor->delete();

      return redirect('proveedor')->with('success', 'Proveedor Eliminado');
    }
}
