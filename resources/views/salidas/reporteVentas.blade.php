@extends('layouts.app')
@section('links')
<!-- <link rel="stylesheet" href="{{ asset('css/reportes.css') }}"> -->
@section('nombre') Reporte de Ventas
@endsection
@endsection
@section('content')
<h1 class="titulo"> Ventas en el año {{$anio}} </h1>

<label id="enero" style="display:none">{{$sumEne}}</label>
<label id="febrero" style="display:none">{{$sumFeb}}</label>
<label id="marzo" style="display:none">{{$sumMar}}</label>
<label id="abril" style="display:none">{{$sumAbr}}</label>
<label id="mayo" style="display:none">{{$sumMay}}</label>
<label id="junio" style="display:none">{{$sumJun}}</label>
<label id="julio" style="display:none">{{$sumJul}}</label>
<label id="agosto" style="display:none">{{$sumAgo}}</label>
<label id="septiembre" style="display:none">{{$sumSep}}</label>
<label id="octubre" style="display:none">{{$sumOct}}</label>
<label id="noviembre" style="display:none">{{$sumNov}}</label>
<label id="diciembre" style="display:none">{{$sumDic}}</label>

<div class="container-grafica">

    <canvas id="bar-chart" width="800" height="350" class="grafica"></canvas>
 
</div>

<br><br>
<form method="POST" action="{{ action('SalidaController@obtenerVentas') }}">
{{ csrf_field() }}
<div id="main">
  <div class="filtroAnio">
  <select class="custom-select" name="fecha">
        <option disabled selected> Año</option>
        @if($anios)
          @foreach ($anios as $clave => $valor)
            <option> {{ $anios[$clave]->fecha }} </option>
          @endforeach
        @else
          <option>No existen salidas</option>
        @endif
      </select>
  </div>
  <br>
  <div class="bntFiltro">
    <button type="submit" name="action" value="filtro" class="btn btn-success">Filtrar</button>
  </div>
  <br><br>
<button type="submit" name="action" value="reporte" class="btn btn-success">Obtener reporte</button>
</div>
</form>

@section('script')

<script src="{{ asset('js/Chart.min.js') }}"></script>
<script src="{{ asset('js/chart-ventas.js') }}"></script>
@endsection
@endsection