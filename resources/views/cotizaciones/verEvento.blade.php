@extends('layouts.app')
@section('nombre')
  Cotizacion Evento
@endsection
@section('links')
  <meta charset="utf-8">
  <title>MagicCopy</title>
  <link rel="stylesheet" href="/css/producto.css">

@endsection
@section('content')
  {{-- @auth --}}
  <div class="container">
    <br>
    <h1 class="principal"> Cotizacion Evento # {{$evento->codigo}} </h1>
    <br>
    <div class="centrado">
      <div class="boton">
        <a href="/cotizaciones" class="btn btn-info"> Regresar </a>
      </div>
      <div class="derecha">
        <img class="imagen" src='/images/cotizacionesEventos/{{$evento->imagen}}' alt="">

        <div class="">
          <h2><strong>Datos personales</strong></h2>
        </div>
        <div class="">
          <h3><strong>Nombre: </strong><label>{{$evento->nombre_cliente}}</label></h3>
        </div>
        <div class="">
          <h3><strong>Correo: </strong><label>{{$evento->correo}}</label></h3>
        </div>
        <div class="">
          <h3><strong>Numero de Telefono: </strong><label>{{$evento->num_telefono}}</label></h3>
        </div>
      </div>
      <div class="">
        <h3><strong>Codigo: </strong><label>{{$evento->codigo}}</label></h3>
      </div>
      <div class="">
        <h3><strong>Cantidad de Personas: </strong><label>{{$evento->cantidad_personas}}</label></h3>
      </div>
      <div class="">
        <h3><strong>Lugar: </strong><label>
          @foreach ($clasificaciones as $clasificacion)
            @if ($evento->codigo_clasificacion == $clasificacion->id)
              <td> {{ $clasificacion->nombre }} </td>
              <td>{{ $evento->lugar}}</td>
            @endif
          @endforeach</label></h3>
        </div>
        <div class="">
          <h3><strong>Fecha de Evento: </strong><label>{{$evento->fecha_evento}}</label></h3>
        </div>
        <div class="">
          <h3><strong>Tema del Evento: </strong><label>{{$evento->tema}}</label></h3>
        </div>
        <div class="">
          <h3><strong>tarjetas: </strong><label>
            @if ($evento->tarjetas == 1)
              Si
            @else
              No
            @endif
            </label></h3>
        </div>
        <div class="">
          <h3><strong>Mesa con Boquitas: </strong><label>
            @if ($evento->mesa_boquitas == 1)
              Si
            @else
              No
            @endif
            </label></h3>
        </div>
        <div class="">
          <h3><strong>Centros de Mesa: </strong><label>
            @if ($evento->centros_mesa == 1)
              Si
            @else
              No
            @endif
            </label></h3>
        </div>
        <div class="">
          <h3><strong>Arco de Entrada: </strong><label>
            @if ($evento->arco_entrada == 1)
              Si
            @else
              No
            @endif
            </label></h3>
        </div>
        <div class="">
          <h3><strong>Recuerdos: </strong><label>
            @if ($evento->recuerdos == 1)
              Si
            @else
              No
            @endif
            </label></h3>
        </div>
        <div class="">
          <h3><strong>Comida: </strong><label>
            @if ($evento->comida == 1)
              Si
            @else
              No
            @endif
            </label></h3>
        </div>
        <div class="">
          <h3><strong>Descripcion: </strong><label>{{$evento->descripcion}}</label></h3>
        </div>

      </div>
      <br><br>
    </div>
    {{-- @endauth --}}
  @endsection
