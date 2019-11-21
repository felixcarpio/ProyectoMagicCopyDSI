@extends('layouts.app')
@section('nombre')
Salida
@endsection
@section('links')
<link href="{{ asset('css/promocion.css') }}" rel="stylesheet">
@endsection
@section('content')
@auth
<div class="container">
    <br>
    <br>
    <div class="boton">
        <a href="/versalidas" class="btn btn-info"> Regresar </a>
    </div>
    <br><br>
    <div class="centrado">
    <div class="">
            <h3><strong>Tipo de salida: </strong><label>{{ $tipo }}</label></h3>
        </div>


        <div class="">
            <h3><strong>Fecha de emision: </strong><label> {{ date('d/m/Y', strtotime($salida[0]->fecha_emision)) }} </label></h3>
        </div>
        <div class="">
            <h3><strong>Total: </strong><label>{{$salida[0]->total}}</label></h3>
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
                    @for($i=0;$i<count($salida);$i++)
                    <tr>
                        <td align="center" class=""> {{ $salida[$i]->nombre }} </td>
                        <td align="center" class=""> {{ $salida[$i]->cantidad_vendida }} </td>
                        <td align="center" class=""> {{ $salida[$i]->costo }} </td>
                    </tr>
                    @endfor
                </tbody>
            </table>
            <br><br>
        </div>


</div>

@endsection
@endauth