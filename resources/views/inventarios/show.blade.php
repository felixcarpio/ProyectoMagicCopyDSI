@extends('layouts.app')
@section('nombre')
Pedido
@endsection
@section('links')
<link href="{{ asset('css/promocion.css') }}" rel="stylesheet">
@endsection
@section('content')
@auth
<div class="container">
    <br>
    <h1 class="principal"> Pedido P{{$pedido[0]->codigo}} </h1>
    <br>
    <div class="boton">
        <a href="/verpedidos" class="btn btn-info"> Regresar </a>
    </div>
    <br><br>
    <div class="centrado">

        <div class="">
            <h3><strong>Fecha de solicitud: </strong><label> {{ date('d/m/Y', strtotime($pedido[0]->fecha_solicitud)) }}</label></h3>
        </div>
        <div class="">
            <h3><strong>Fecha de recepcion: </strong><label>                        {{ date('d/m/Y', strtotime($pedido[0]->fecha_recibido)) }}</label></h3>
        </div>
        <div class="">
            <h3><strong>Proveedor: </strong><label>{{$proveedor[0]->nombre}}</label></h3>
        </div>
      
    </div>

    <br><br>

    <div class="">
            <h2><strong>Productos solicitados: </strong></h2>
            <table>
                <thead>
                    <tr align="center">
                        <th width="250" class="">Nombre</th>
                        <th width="200" class="">Cantidad ordenada</th>
                        <th width="200" class="">Costo unitario</th>
                    </tr>
                </thead>
                <tbody>
                    @for($i=0;$i<count($pedido);$i++)
                    <tr>
                        <td align="center" class=""> {{ $pedido[$i]->nombre }} </td>
                        <td align="center" class=""> {{ $pedido[$i]->cantidad_ordenada }} </td>
                        <td align="center" class=""> {{ $pedido[$i]->costo_unitario }} </td>
                    </tr>
                    @endfor
                </tbody>
            </table>
            <br><br>
        </div>


</div>

@endsection
@endauth