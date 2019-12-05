<?php

namespace App\Http\Controllers;

use App\Pieza;
use App\Ticket;
use Illuminate\Http\Request;

class PiezaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('piezas.agregarPieza');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Ticket $ticket)
    {

        return view('piezas.agregarPieza');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Ticket $ticket)
    {
        //
        $lastid = $ticket->id;
        if(count($request->nombre) > 0){
            foreach($request->nombre as $item => $v){
                $data=array(
                    'nombre' => $request->nombre[$item],
                    'precio_unitario' => $request->precio_unitario[$item],
                    'precio_venta' => $request->precio_venta[$item],
                    'cantidad' => $request->cantidad[$item],
                    'subtotal' => $request->subtotal[$item],
                    'ticket_id' => $lastid
                );
                Pieza::insert($data);
            }
        }
        return redirect()->route('tickets.index')->with('success','Las piezas se agregaron con éxito');
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
