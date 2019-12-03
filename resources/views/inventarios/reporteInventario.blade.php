@extends('layouts.app')
@section('nombre') Reporte de Inventario
@endsection
@section('links')
<link rel="stylesheet" href="{{ asset('css/salida.css') }}">
@endsection
@section('content')
@auth
<h1>Filtros para reporte de inventario</h1>
<form method="POST" action = "{{ action('InventarioController@reporteInventario') }}">
  {{ csrf_field() }}

  <div class="form-group">
    <label>Seleccione el producto</label>
    <select class="custom-select" name="producto" id="selectProductos">
      <option disabled selected> Lista de Productos</option>
      <option> Todos los Productos</option>
      @if($productos)
      @foreach ($productos as $producto)
      <option> {{ $producto->nombre }} </option>
      @endforeach
      @else
      <option>No existen Productos</option>
      @endif
    </select>
  </div>
  <div class="form-group">
    <label>Seleccione el año</label>
    <select class="custom-select" name="fecha">
        <option disabled selected> Año</option>
        <option> Todos los años</option>
        @if($anios)
          @foreach ($anios as $clave => $valor)
            <option> {{ $anios[$clave]->fecha }} </option>
          @endforeach
        @else
          <option>No existen salidas</option>
        @endif
      </select>
  </div>
  <button type="submit" class="btn btn-success">Generar Reporte</button>

</form>
@endsection
@endauth