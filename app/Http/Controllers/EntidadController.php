<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entidad;

class EntidadController extends Controller
{
    public function index()
    {
        $entidades = Entidad::all();
        return view('salidas.entidad')->with('entidades', $entidades);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required',
            'nit' => 'required',
            'numero_registro' => 'required',
            'giro' => 'required',
        ]);

        $entidad = new Entidad;
        $entidad->nombre = $request->input('nombre');
        $entidad->nit = $request->input('nit');
        $entidad->numero_registro = $request->input('numero_registro');
        $entidad->direccion = $request->input('direccion');
        $entidad->giro = $request->input('giro');

        $entidad->save();

        return redirect('entidad')->with('success', 'La Entidad se guardó exitosamente');
    }

    public function storeEnVenta(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required',
            'nit' => 'required',
            'numero_registro' => 'required',
            'giro' => 'required',
        ]);

        $entidad = new Entidad;
        $entidad->nombre = $request->input('nombre');
        $entidad->nit = $request->input('nit');
        $entidad->numero_registro = $request->input('numero_registro');
        $entidad->direccion = $request->input('direccion');
        $entidad->giro = $request->input('giro');

        $entidad->save();

        return redirect('salida/venta')->with('success', 'La Entidad se guardó exitosamente');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nombre' => 'required',
            'nit' => 'required',
            'numero_registro' => 'required',
            'giro' => 'required',
        ]);

        $entidad = Entidad::find($id);
        
        $entidad->nombre = $request->input('nombre');
        $entidad->nit = $request->input('nit');
        $entidad->numero_registro = $request->input('numero_registro');
        $entidad->direccion = $request->input('direccion');
        $entidad->giro = $request->input('giro');

        $entidad->save();

        return redirect('entidad')->with('success', 'La Entidad se actualizó exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $entidad = Entidad::find($id);
        $entidad->delete();

        return redirect('entidad')->with('succes', 'Entidad eliminada');
    }
}
