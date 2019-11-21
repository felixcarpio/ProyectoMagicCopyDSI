<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Contacto;
use App\Empresa;
use App\Telefono;
use Storage;
use Session;

class ContactoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $contactos = DB::table('contactos')
            ->select('contactos.id', 'contactos.nombre', 'contactos.apellido', 'contactos.correo', 'contactos.dui','contactos.direccion','contactos.empresa_id')->get();
       
        $empresas = Empresa::all();        
        $telefonos = Telefono::all();

        return view('contactos.contacto', compact('contactos'))->with('empresas',$empresas)->with('telefonos',$telefonos)->with('contacto',$contactos);
    }

    public function ingresar()
    {
        $contactos = Contacto::all();      
        $telefonos = Telefono::all();

        $empresas = Empresa::all();  
        return view('contactos.ingresarc', compact('contactos'))->with('empresas',$empresas)->with('telefonos',$telefonos)->with('contacto',$contactos);
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
            'apellido' => 'required',
            'correo' => 'required',
            'dui' =>'required|regex:/^[0-9]{8}-[0-9]{1}$/',
            'direccion' =>'required', 
            'empresa_id' =>'required',   
          ]);

          //$contactos = new Contacto;

          $data=$request->all();
            $lastid= Contacto::create($data)->id;
            if(count($request->numero)>0)
            {
            foreach ($request->numero as $item => $v){ 
              $data2 = array(
                   'contacto_id' =>$lastid,
                   'numero' =>$request->numero[$item]    
              );
              Telefono::insert($data2);     
            }
        }
          return redirect('contac/ingresar')->with('success', 'El nuevo Contacto se guardó exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
        $contacto = Contacto::find($id);        
        $empresas = Empresa::all();
        $telefonos= Telefono::where('contacto_id','=',$id)->get();

        return view('contactos.ver', compact('telefonos','empresas','contacto'));
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function actualizar($id)
    {
        $contacto = Contacto::find($id);        
        $empresas = Empresa::all();
        $telefonos= Telefono::where('contacto_id','=',$id)->get();


        return view('contactos.actualizar', compact('contacto', 'empresas', 'telefonos'));
    }

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
            'apellido' => 'required',
            'correo' => 'required',
            'dui' =>'required|regex:/^[0-9]{8}-[0-9]{1}$/',
            'direccion' =>'required', 
            'empresa_id' =>'required',   
          ]);

          $data=$request->all();
            $lastid= Contacto::find($data)->id;
            if(count($request->numero)>0)
            {
            foreach ($request->numero as $item => $v){ 
              $data2 = array(
                   'contacto_id' =>$lastid,
                   'numero' =>$request->numero[$item]    
              );
              Telefono::insert($data2);     
            }
        }

          return redirect('contac/editar')->with('success', 'El nuevo Contacto se actualizó exitosamente');
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
