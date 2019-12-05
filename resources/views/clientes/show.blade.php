@extends('layouts.appticket')
@section('nombre')
Ingresar Cliente
@endsection

@section('content')
@auth

<div class="container">
    <br>
    <h1 class="principal"> Información del cliente: </h1>
    <br><br>
    <div class="centrado">
      <div class="boton">
        <a href="/clientes" class="btn btn-info"> Regresar </a>
      </div>

      <br><br><br>
      <div class="">
        <h3><strong>Nombre: </strong><label>{{$cliente->nombre}}</label></h3>
      </div>
      <div class="">
        <h3><strong>Apellido: </strong><label>{{$cliente->apellido}}</label></h3>
      </div>
      <div class="">
        <h3><strong>Correo electrónico: </strong><label>{{$cliente->correo}}</label></h3>
      </div>
  
      <div class="derecha">
        <h3><strong>DUI: </strong><label>{{$cliente->dui}}</label></h3>  
      </div>
      <div class="derecha">
        <h3><strong>Dirección: </strong><label>{{$cliente->direccion}}</label></h3>  
      </div>  
      <div class="derecha">
        <h3><strong>Nombre de la Empresa: </strong><label>{{$cliente->nombre_empresa}}</label></h3>      
        </div>
      <div class="derecha">
        <h3><strong>Giro de la empresa: </strong><label>{{$cliente->giro}}</label></h3>    
        </div>
      <div class="derecha">
      <h3><strong>NIT: </strong><label>{{$cliente->nit}}</label></h3>    
      </div>
      <div class="derecha">
      <h3><strong>Registro: </strong><label>{{$cliente->registro}}</label></h3>    
      </div>
      <div class="derecha">
      <h3><strong>Telefono principal: </strong><label>{{$cliente->telefono}}</label></h3>    
      </div>
      <div class="derecha">
      <h3><strong>Telefono: </strong><label>{{$cliente->telefono2}}</label></h3>    
      </div>

      @endauth
      @endsection