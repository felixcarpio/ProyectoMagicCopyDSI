@extends('layouts.app')
@section('nombre')
  Producto
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
    <h1 class="principal"> Producto {{$producto->nombre}} </h1>
    <br><br>
    <div class="centrado">
      <div class="boton">
        <a href="/producto" class="btn btn-info"> Regresar </a>
      </div>
      <div class="derecha">
        <img class="imagen" src='/images/{{$producto->imagen}}' alt="">
      </div>
      <div class="">
        <h3><strong>Codigo: </strong><label>{{$producto->codigo}}</label></h3>
      </div>
      <div class="">
        <h3><strong>Descripcion: </strong><label>{{$producto->descripcion}}</label></h3>
      </div>
      <div class="">
        <h3><strong>Precio: </strong><label>${{$producto->precio}}</label></h3>
      </div>
      <div class="">
        <h3><strong>Precio Con Descuento: </strong><label>${{$producto->precio_con_descuento}}</label></h3>
      </div>
      <div class="">
        <h3><strong>Existencias: </strong><label>{{$producto->existencias}}</label></h3>
      </div>
      <div class="">
        <h2><strong>Marcas: </strong><label>
          @foreach ($marcas as $marca)
            @if ($producto->marcas_id == $marca->id)
              <td> {{ $marca->nombre }} </td>
            @endif
          @endforeach</label></h2>
        </div>
        <div>
          <h3><strong>Proveedores:</strong></h3>
          <div class="scroll">
            <h3>
              @php
              $sum = 1;
              @endphp
              @foreach ($productoProveedor as $productoPro)
                <label>Proveedor {{ $sum }} : {{ $productoPro->nombre }}. </label>
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
    </div>
    @endauth
  @endsection
