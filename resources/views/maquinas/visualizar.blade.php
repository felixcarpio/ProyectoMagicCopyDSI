@extends('layouts.appticket')
@section('nombre')
  Maquina
@endsection
@section('content')

<!--{{ $maquinaContacto }}-->

<div class="container">
    <br>
    @foreach ($maquinaContacto as $key => $tabla)
    <h1 class="principal"> Cliente: {{$tabla->connombre}} {{$tabla->apellido}} </h1>
    <br><br>
    <div class="centrado">
      <div class="boton">
        <a href="/maquina" class="btn btn-info"> Regresar </a>
      </div>

      <br><br><br>
      <div class="">
        <h3><strong>Dui: </strong><label>{{$tabla->dui}}</label></h3>
      </div>
      <div class="">
        <h3><strong>Dirección: </strong><label>{{$tabla->direccion}}</label></h3>
      </div>
      <div class="">
        <h3><strong>Correo: </strong><label>{{$tabla->correo}}</label></h3>
      </div>
      <div class="">
      
     
       

      
      <div class="derecha">
        <h3><strong>Categoria: </strong><label>{{$tabla->catnombre}}</label></h3>  
      </div>
      <div class="derecha">
        <h3><strong>Marca: </strong><label>{{$tabla->marca}}</label></h3>  
      </div>  
      <div class="derecha">
        <h3><strong>Modelo: </strong><label>{{$tabla->modelo}}</label></h3>      
        </div>
      <div class="derecha">
        <h3><strong>Contador: </strong><label>{{$tabla->contador}}</label></h3>    
        </div>
      <div class="derecha">
      <h3><strong>Serie: </strong><label>{{$tabla->serie}}</label></h3>    
      </div>

      @endforeach
@endsection