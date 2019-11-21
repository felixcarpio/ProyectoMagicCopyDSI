@extends('layouts.app')
@section('nombre')
Promoción
@endsection
@section('links')
<link href="{{ asset('css/promocion.css') }}" rel="stylesheet">
@endsection
@section('content')
@auth
<div class="container">
    <br>
    <h1 class="principal"> {{$promocion->nombre}} </h1>
    <br>
    <div class="boton">
        <a href="/promocion" class="btn btn-info"> Regresar </a>
    </div>
    <div class="boton">
        <a href=" {{ route('promocion.actualizar', $promocion->id) }} " class="btn btn-warning editar"> Actualizar </a>
    </div>
    <br><br>
    <div class="centrado">

        <div class="derecha">
            <img width="370px" class="imagen" src='/images/promociones/{{$promocion->imagen}}' alt="">
        </div>
        <div class="">
            <h3><strong>Fecha de inicio: </strong><label>{{ $promocion->fecha_inicio }}</label></h3>
        </div>
        <div class="">
            <h3><strong>Fecha de finalización: </strong><label>{{$promocion->fecha_fin}}</label></h3>
        </div>
        <div class="">
            <h3><strong>Precio original: </strong><label>${{$promocion->precio_sin_descuento}}</label></h3>
        </div>
        <div class="">
            <h3><strong>Precio aplicando la promoción: </strong><label>{{$promocion->precio_con_descuento}}</label></h3>
        </div>
        <br><br> <br>
        <div class="">
            <h2><strong>Productos que incluye la promoción: </strong></h2>
            <table>
                <thead>
                    <tr>
                        <th width="300" class="">Nombre</th>
                        <th width="50" class="">Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productos as $producto)
                    <tr>
                        <td class=""> {{ $producto->nombre }} </td>
                        <td align="center" class=""> {{ $producto->cantidad }} </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <br><br>
        </div>
    </div>

    <br><br>


</div>

@endsection
@endauth