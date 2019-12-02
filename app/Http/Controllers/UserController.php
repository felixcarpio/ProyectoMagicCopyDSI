<?php

namespace App\Http\Controllers;

use App\User;
use App\Rol;
use Session;
use Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\RegistersUsers;
use Caffeinated\Shinobi\Models\Role;

class UserController extends Controller
{

    public function __construct(){
      $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $User = User::all();
        $roles = Rol::all();
        return view('users.index',compact('User','roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombre' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $request->validate([
        'username' => 'required',
        'nombre' => 'required',
        'apellido' => 'required',
        'email' => 'required',
        'password' => 'required',
        'direccion_usuario' => 'required',
        'telefono_usuario' => 'required',
        'roles_id' => 'required'
      ]);
      $User                     = new User;
      $User->username           = $request->username;
      $User->nombre             = $request->nombre;
      $User->apellido           = $request->apellido;
      $User->email              = $request->email;
      $User->password           = Hash::make($request->password);
      $User->activo             = 1;
      $User->direccion_usuario  = $request->direccion_usuario;
      $User->telefono_usuario   = $request->telefono_usuario;
      $User->save();
      $User->roles()->sync($request->roles_id);
      return redirect()->route('users.index')->with('success','El Usuario se ingresó correctamente');
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
          'username' => 'required',
          'nombre' => 'required',
          'apellido' => 'required',
          'email' => 'required',
          'direccion_usuario' => 'required',
          'telefono_usuario' => 'required',
          'roles_id' => 'required'
        ]);

        $user = User::find($id);
        $user->username = $request->input('username');
        $user->nombre = $request->input('nombre');
        $user->apellido = $request->input('apellido');
        $user->email = $request->input('email');
        $user->direccion_usuario = $request->input('direccion_usuario');
        $user->telefono_usuario = $request->input('telefono_usuario');
        $user->save();
        $user->roles()->sync($request->roles_id);
        return redirect('users')->with('success','El Usuario se actualizó correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect('users')->with('success','Usuario Eliminado');
    }
}
