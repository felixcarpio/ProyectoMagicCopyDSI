<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Maquina;
use App\Ticket;
use App\Categoria;
use App\Cliente;
use Carbon\Carbon;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $maquinas = Maquina::all();
        $categorias = Categoria::all();
        $clientes = Cliente::all();
        $tickets = DB::table('categorias')
        ->join('maquinas', 'maquinas.categoria_id', 'categorias.id')
        ->join('tickets','tickets.maquina_id','maquinas.id')
        ->select('tickets.id', 'tickets.codigo', 'tickets.estado', 'tickets.fecha_inicio', 'tickets.fecha_fin', 
        'tickets.total', 'tickets.comentario', 'maquinas.serie', 'categorias.nombre' )
        ->get();
        return view('tickets.index',compact('tickets','maquinas','categorias','clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categorias = Categoria::all();
        $maquinas = Maquina::all();
        return view('tickets.create',compact('categorias','maquinas'));
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
            'codigo' => 'required',
            'estado' => 'required',
            'fecha_inicio' => 'required',
            'comentario' => 'required',
            'serie' => 'required',
            'arrendamiento' => 'required',
            'reparacionfc' => 'required',
            'reparacionpc' => 'required',
        ]);

        $ticket = new Ticket;
        $ticket->codigo = $request->input('codigo');
        $ticket->estado = $request->input('estado');
        $ticket->fecha_inicio = $request->input('fecha_inicio');
        $ticket->comentario = $request->input('comentario');
        $ticket->arrendamiento = $request->input('arrendamiento');
        $ticket->reparacionfc = $request->input('reparacionfc');
        $ticket->reparacionpc = $request->input('reparacionpc');
        $maquina = DB::table('maquinas')
        ->select('maquinas.id')
        ->where('maquinas.serie','=',$request->input('serie'))
        ->get();
        $ticket->total = $ticket->arrendamiento + $ticket->reparacionpc + $ticket->reparacionfc;
        $ticket->maquina_id = $maquina[0]->id;
        $ticket->save();

        return redirect()->route('tickets.index')->with('success','El Ticket se ingresó correctamente');
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
    public function edit(Ticket $ticket)
    {
        //
        $maquinas = Maquina::all();
        $m = DB::table('maquinas')
        ->join('tickets','tickets.maquina_id','maquinas.id')
        ->select('maquinas.serie')
        ->where('maquinas.id','=',$ticket->maquina_id)
        ->where('tickets.id','=',$ticket->id)
        ->get()
        ->toArray();
        $serie=$m[0]->serie;
        return view('tickets.edit',compact('ticket','serie','maquinas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
        $this->validate($request,[
            'codigo' => 'required',
            'estado' => 'required',
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required',
            'comentario' => 'required',
            'serie' => 'required',
            'arrendamiento' => 'required',
            'reparacionfc' => 'required',
            'reparacionpc' => 'required',
        ]);

        $ticket->codigo = $request->input('codigo');
        $ticket->estado = $request->input('estado');
        $ticket->fecha_inicio = $request->input('fecha_inicio');
        $ticket->fecha_fin = $request->input('fecha_fin');
        $ticket->comentario = $request->input('comentario');
        $ticket->arrendamiento = $request->input('arrendamiento');
        $ticket->reparacionfc = $request->input('reparacionfc');
        $ticket->reparacionpc = $request->input('reparacionpc');
        $maquina = DB::table('maquinas')
        ->select('maquinas.id')
        ->where('maquinas.serie','=',$request->input('serie'))
        ->get();
        $ticket->total = $ticket->arrendamiento + $ticket->reparacionpc + $ticket->reparacionfc;
        $ticket->maquina_id = $maquina[0]->id;
        $ticket->save();

        return redirect()->route('tickets.index')->with('success','El Ticket se actualizó correctamente');

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
