@extends('layouts.appticket')
@section('nombre')
  Producto
@endsection
@section('links')
  <meta charset="utf-8">
  <title>MagicCopy</title>
  <link rel="stylesheet" href="/css/contacto.css">

@endsection
@section('content')
@auth

    <div class="container">
    <br>
    <h1 class="principal">Contacto: {{$contacto->nombre.",".$contacto->apellido}}</h1>
    <br>
    <div class="boton">
        <a href="/contacto" class="btn btn-info"> Regresar </a>
    </div>
    <br><br>
    <div class="izquierda">

      <div class="">
        <h3><strong>Correo: </strong><label>{{$contacto->correo}}</label></h3>
      </div>
      <br>
      <div class="">
        <h3><strong>DUI: </strong><label>{{$contacto->dui}}.</label></h3>
      </div>
      <br>
      <div class="">
        <h3><strong>Dirección: </strong><label>{{$contacto->direccion}}.</label></h3>
      </div>
      <br>
        <div class="">
        <h3><strong>Empresa: </strong><label>
          @foreach ($empresas as $empresa)
            @if ($contacto->empresa_id == $empresa->id)
              <td> {{ $empresa->nombre }}. </td>
            @endif
          @endforeach</label></h3>
        </div>
        <br>
            <div>
            <h3><strong>Telefonos:</strong></h3>
            <div class="scroll">
                <h3>
                    @php
                    $sum = 1;
                    @endphp
                    @foreach ($telefonos as $key=>$telefono)
                    <label>Número {{ $sum }} : {{$telefono->numero}}.</label>
                    @php
                    $sum = 1 + $sum;
                    @endphp
                    <br>
                    @endforeach
                </h3>
            </div>

        </div>
       </div>
      <br><br>
    @endauth
  @endsection
