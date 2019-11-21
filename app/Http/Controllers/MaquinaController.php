<?php

namespace App\Http\Controllers;
use App\Maquina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Categoria;
use App\Contacto;

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
        $contactos = Contacto::all();


      $maquinaContacto = DB::table('contacto_maquina')
      ->join('contactos', 'contacto_maquina.contacto_id', 'contactos.id')
      ->join('maquinas', 'contacto_maquina.maquina_id', 'maquinas.id')
      ->join('categorias','maquinas.categoria_id','categorias.id')
      ->select('maquinas.id', 'contactos.nombre AS con_nombre', 'categorias.nombre', 'maquinas.marca', 'maquinas.modelo', 
      'maquinas.serie', 'maquinas.contador', 'maquinas.descripcion')
      ->get();
        
        return view('maquinas.maquina')->with('contactos',$contactos)->with('categorias',$categorias)->with('maquinas',$maquinas)->with('maquinaContacto',$maquinaContacto);
    
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
                'contacto_id' => 'required',
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
        $contacto = new Contacto;

        $maquina->categoria_id = $request->input(('categoria_id'));
        $maquina->marca = $request->input(('marca'));
        $maquina->modelo = $request->input(('modelo'));
        $maquina->contador = $request->input(('contador'));
        $maquina->serie = $request->input(('serie'));
        $maquina->descripcion = $request->input(('descripcion'));
        $maquina->save();

        $maquina->contactos()->attach($request->get('contacto_id'));
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
      ->join('contacto_maquina','maquinas.id','contacto_maquina.maquina_id')
      ->join('contactos', 'contacto_maquina.contacto_id', 'contactos.id')
      ->select('categorias.nombre as catnombre', 'maquinas.marca', 'maquinas.modelo', 'maquinas.contador', 'maquinas.serie', 'contactos.nombre as connombre', 'contactos.apellido', 'contactos.correo', 'contactos.dui', 'contactos.direccion')
      ->where('maquinas.id', $id)
      ->get();

        $maquinas=Maquina::find($id);
        //$categorias = Categoria::all();
        return view('maquinas.visualizar',compact('maquinaContacto', 'maquinas','contactos','categorias'));
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
            'contacto_id' => 'required',
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
        
        $maquina->contactos()->sync($request->get('contacto_id'));
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
