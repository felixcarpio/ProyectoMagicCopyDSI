@extends('layouts.app')
@section('nombre')
  Cotizacion
@endsection
@section('links')
  <meta charset="utf-8">
  <title>MagicCopy</title>
  <link rel="stylesheet" href="/css/producto.css">

@endsection
@section('content')
  @auth
  <div class="container">
    <br>
    <h1 class="principal"> Cotizacion # {{$cotizacion->codigo}} </h1>
    <br>
    <div class="centrado">
      <div class="boton">
        <a href="/cotizaciones" class="btn btn-info"> Regresar </a>
      </div>
      <div class="derecha">
        <img class="imagen" src='/images/cotizaciones/{{$cotizacion->imagen}}' alt="">
      </div>
      <div class="izquierda">
        <div class="">
          <h3><strong>Codigo: </strong><label>{{$cotizacion->codigo}}</label></h3>
        </div>
        <div class="">
          <h3><strong>Fecha de Solicitud: </strong><label>{{ date('d/m/Y', strtotime($cotizacion->fecha_solicitud)) }}</label></h3>
        </div>
        <div class="">
          <h3><strong>Descripcion: </strong><label>{{$cotizacion->descripcion_producto}}</label></h3>
        </div>
        <div class="">
          <h3><strong>Nombre de Cotizador: </strong><label>{{$cotizacion->nombre_contacto}}</label></h3>
        </div>
        <div class="">
          <h3><strong>Correo: </strong><label>{{$cotizacion->correo_contacto}}</label></h3>
        </div>
        <div class="">
          <h3><strong>Telefono: </strong><label>{{$cotizacion->telefono}}</label></h3>
        </div>
      </div>
    </div>

    <br><br>


  </div>


  @endauth

@endsection
