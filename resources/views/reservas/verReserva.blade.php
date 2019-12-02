@extends('layouts.app')
@section('nombre')
  Reserva
@endsection
@section('links')
  <meta charset="utf-8">
  <title>MagicCopy</title>
  <link rel="stylesheet" href="/css/producto.css">

@endsection
@section('content')
  {{-- @auth  --}}
    <div class="container">
      <br>
      <h1 class="principal"> Reserva # {{$reserva->codigo_reserva}} </h1>
      <br>
      <div class="centrado">
            <div class="boton">
              <a href="/reservas" class="btn btn-info"> Regresar </a>
            </div>
            {{-- <div class="derecha">

            </div> --}}
            <div class="">
              <h3><strong>Codigo: </strong><label>{{$reserva->codigo_reserva}}</label></h3>
            </div>
            <div class="">
              <h3><strong>Nombre: </strong><label>{{$reserva->nombre}}</label></h3>
            </div>
            <div class="">
              <h3><strong>Descripcion: </strong><label>{{date('d/m/Y', strtotime($reserva->fecha_solicitud))}}</label></h3>
            </div>
            <div class="">
              <h2><strong>Estado: </strong><label>
                @foreach ($estados as $estado)
                  @if ($reserva->estado_reserva_id == $estado->id)
                    <td> {{ $estado->nombre }} </td>
                  @endif
                @endforeach</label></h2>
              </div>
            <div class="">
              <h3><strong>Fecha de vencimiento: </strong><label>{{$reserva->fecha_vencimiento}}</label></h3>
            </div>
            <div class="">
              <h3><strong>Correo: </strong><label>{{$reserva->correo_comprador}}</label></h3>
            </div>
            <div class="">
              <h3><strong>Telefono: </strong><label>{{$reserva->telefono_reserva}}</label></h3>
            </div>
            <div class="">
              <h3><strong>Fecha de Reclamo: </strong><label>{{date('d/m/Y', strtotime($reserva->fecha_reclamo))}}</label></h3>
            </div>
        </div>
        <br><br>
      </div>
    {{-- @endauth  --}}

  @endsection
