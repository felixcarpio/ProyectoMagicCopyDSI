@extends('layouts.appticket')
@section('nombre')
Ingresar Cliente
@endsection
@section('links')
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}}
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"> --}}
<link rel="stylesheet" href="/css/inventario.css">
<link rel="stylesheet" href="/css/style-mc.css">
@endsection
@section('content')
@auth
    <div class="container">
        <h3>Nuevo Cliente</h3>
        <p><span style="color:red">*</span><span class="campoObligatorio">Campo Obligatorio</span></p>
        <form method="POST" action="{{route('clientes.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="col-form-label">Nombre de Cliente: <span style="color:red">*</span></label>
                <input type="text" name="nombre" class="form-control" placeholder="Ingrese los nombres del cliente">
                <label class="col-form-label">Apellido de Cliente: <span style="color:red">*</span></label>
                <input type="text" name="apellido" class="form-control" placeholder="Ingrese los apellidos del cliente">
                <label class="col-form-label">Correo de Cliente: <span style="color:red">*</span></label>
                <input type="email" name="correo" class="form-control" placeholder="example@correo.com">
                <label class="col-form-label">DUI de Cliente: <span class="aclaracion"> Digitar los dígitos con guiones </span> </label>
                <input type="text" name="dui"  pattern="[0-9]{8}-[0-9]{1}" class="form-control" placeholder="99999999-9">
                <label class="col-form-label">Dirección de Cliente: <span style="color:red">*</span></label>
                <input type="text" name="direccion" class="form-control" placeholder="Ingrese la direccion del cliente">
                <label class="col-form-label">Nombre de Empresa: </label>
                <input type="text" name="nombre_empresa" class="form-control" placeholder="Ingrese el nombre de la empresa">
                <label class="col-form-label">Giro de la empresa: </label>
                <input type="text" name="giro" class="form-control" placeholder="Ingrese el giro de la empresa">
                <label class="col-form-label">NIT: <span class="aclaracion"> Digitar los dígitos con guiones </span></label>
                <input type="text" name="nit" pattern="[0-9]{3}-[0-9]{6}-[0-9]{3}-[0-9]{1}" class="form-control" placeholder="999-999999-99-9">
                <label class="col-form-label">Registro:  <span class="aclaracion"> Digitar los dígitos con guiones </span> </label>
                <input type="text" name="registro" class="form-control"  pattern="[0-9]{8}" placeholder="Ingrese el numero de registro de la empresa">
                <label class="col-form-label">Telefono: <span class="aclaracion"> Digitar los dígitos sin guiones </span> <span style="color:red">*</span></label>
                <input type="text" name="telefono" pattern="[0-9]{8}" class="form-control"  placeholder="99999999">
                <label class="col-form-label">Telefono: <span class="aclaracion"> Digitar los dígitos sin guiones </span>  </label>
                <input type="text" name="telefono2" pattern="[0-9]{8}" class="form-control"  placeholder="99999999">
               
               <br>
                <button type="submit" class="btn btn-success guardar">Guardar</button>
                <a href="/clientes" class="btn btn-danger">Cancelar</a>
            </div>
        </form>
    </div>            

    

    @section('script')
                   
    @endsection
@endauth
@endsection