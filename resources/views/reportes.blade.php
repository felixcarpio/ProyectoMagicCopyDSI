@extends('layouts.app')
@section('nombre') Registrar pedido @endsection
@section('nombre') Salida de producto
@endsection
@section('links')
<script src="{{ asset('js/jquery-3.3.1.min.js')}}"></script>
<script src="{{ asset('js/jquery.min.js')}}"></script>

<link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">

@endsection
@section('content')
@auth
<h1>Enlaces a reportes</h1>
<div>
  <a href="/reporteventas" class=" btn btn-success">Reportes de Ventas</a>
</div>
<br>
<div>
  <a href="/reporteInventario" class="btn btn-success">Reportes de Inventario</a>
</div>
@endsection
@endauth  