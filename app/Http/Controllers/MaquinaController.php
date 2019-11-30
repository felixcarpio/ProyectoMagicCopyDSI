<?php

namespace App\Http\Controllers;
use App\Maquina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Categoria;
use App\Cliente;

class MaquinaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = Categoria::all();
        $maquinas = Maquina::all();
        $clientes = Cliente::all();


      $maquinaContacto = DB::table('cliente_maquina')
      ->join('clientes', 'cliente_maquina.cliente_id', 'clientes.id')
      ->join('maquinas', 'cliente_maquina.maquina_id', 'maquinas.id')
      ->join('categorias','maquinas.categoria_id','categorias.id')
      ->select('maquinas.id', 'clientes.nombre AS con_nombre', 'categorias.nombre', 'maquinas.marca', 'maquinas.modelo', 
      'maquinas.serie', 'maquinas.contador', 'maquinas.descripcion')
      ->get();
        
        return view('maquinas.maquina')->with('clientes',$clientes)->with('categorias',$categorias)->with('maquinas',$maquinas)->with('maquinaContacto',$maquinaContacto);
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Maquina.create');
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
                'cliente_id' => 'required',
                'categoria_id' => 'required',
                'marca' => 'required',
                'modelo' => 'required',
                'contador'=> 'required',
                'serie' => 'required',
                'descripcion' => 'required'
            ]
            );

            //aqui se hicieron cambion para contacto maquia
        $maquina = new Maquina;
        $cliente = new Cliente;

        $maquina->categoria_id = $request->input(('categoria_id'));
        $maquina->marca = $request->input(('marca'));
        $maquina->modelo = $request->input(('modelo'));
        $maquina->contador = $request->input(('contador'));
        $maquina->serie = $request->input(('serie'));
        $maquina->descripcion = $request->input(('descripcion'));
        $maquina->save();

        $maquina->clientes()->attach($request->get('cliente_id'));
        return redirect()->route('maquina.index')->with('success','La nueva máquina se ha guardado con éxito');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //join para traer de la tabla intermedia

       //$maquinaContacto = DB::select("select contactos.nombre,maquinas.categoria_id,maquinas.marca,maquinas.modelo,
       //maquinas.contador,maquinas.serie,maquinas.descripcion 
        //from maquinas,contactos,contacto_maquina 
        //where 
        //maquinas.id = contacto_maquina.maquina_id and 
        //contacto_maquina.contacto_id = contactos.id");


        $maquinaContacto = DB::table('categorias')
      ->join('maquinas', 'maquinas.categoria_id', 'categorias.id')
      ->join('cliente_maquina','maquinas.id','cliente_maquina.maquina_id')
      ->join('clientes', 'cliente_maquina.cliente_id', 'clientes.id')
      ->select('categorias.nombre as catnombre', 'maquinas.marca', 'maquinas.modelo', 'maquinas.contador', 'maquinas.serie', 'clientes.nombre as connombre', 'clientes.apellido', 'clientes.correo', 'clientes.dui', 'clientes.direccion')
      ->where('maquinas.id', $id)
      ->get();

        $maquinas=Maquina::find($id);
        //$categorias = Categoria::all();
        return view('maquinas.visualizar',compact('maquinaContacto', 'maquinas','clientes','categorias'));
        //,compact('maquinaContacto', 'maquinas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $maquinas=maquina::find($id);
        return view('maquina.edit',compact('maquinas'));
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
            'cliente_id' => 'required',
            'categoria_id' => 'required',
            'marca' => 'required',
            'modelo' => 'required',
            'contador' => 'required',
            'serie' => 'required',
            'descripcion' => 'required'
        ]);

        //se modifico para la tabla intermedia el actualizar

        $maquina = Maquina::find($id);

        $maquina->categoria_id = $request->input('categoria_id');
        $maquina->marca = $request->input('marca');
        $maquina->modelo = $request->input('modelo');
        $maquina->contador = $request->input('contador');
        $maquina->serie = $request->input('serie');
        $maquina->descripcion = $request->input('descripcion');
        
        $maquina->save();
        
        $maquina->clientes()->sync($request->get('cliente_id'));
       // maquina::find($id)->update($request->all());
        return redirect()->route('maquina.index')->with('success','La máquina se actualizó exitosamente');
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
