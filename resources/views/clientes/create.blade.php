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
                <input type="text" name="nombre" class="form-control">
                <label class="col-form-label">Apellido de Cliente: <span style="color:red">*</span></label>
                <input type="text" name="apellido" class="form-control">
                <label class="col-form-label">Correo de Cliente: <span style="color:red">*</span></label>
                <input type="text" name="correo" class="form-control">
                <label class="col-form-label">DUI de Cliente: </label>
                <input type="text" name="dui" class="form-control">
                <label class="col-form-label">Dirección de Cliente: <span style="color:red">*</span></label>
                <input type="text" name="direccion" class="form-control">
                <label class="col-form-label">Nombre de Empresa: </label>
                <input type="text" name="nombre_empresa" class="form-control">
                <label class="col-form-label">Giro de la empresa: </label>
                <input type="text" name="giro" class="form-control">
                <label class="col-form-label">NIT: </label>
                <input type="text" name="nit" class="form-control">
                <label class="col-form-label">Registro: </label>
                <input type="text" name="registro" class="form-control">
                <label class="col-form-label">Telefono: <span style="color:red">*</span></label>
                <input type="text" name="telefono" class="form-control">
                <label class="col-form-label">Telefono: </label>
                <input type="text" name="telefono2" class="form-control">
               
               <br>
                <button type="submit" class="btn btn-success guardar">Guardar</button>
                <a href="/clientes" class="btn btn-danger">Cancelar</a>
            </div>
        </form>
    </div>            

    

                <!-- Inicio tabla telefono -->
                

@endauth
@endsection