@extends('layouts.app')
@section('nombre')
Inventario
@endsection
@section('links')
  <link rel="stylesheet" href="/css/inventario.css">
@endsection
@section('content')
  <div class="container">
    <h1 class="titulo"> Salidas </h1>
    <br>
    @if(count($errors) > 0)

      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
          @endforeach
        </ul>
      </div>
    @endif

    @if (\Session::has('success'))
      <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p> 
      </div>
    @endif

    <a href="/salida/venta" class="btn btn-success ingresar">
      Registrar salida de productos
    </a>

    <a class="btn btn-success btn-recepcion ingresar" href="/tipo">
      Tipos de salida
    </a>

    <a href="/inventario" class="btn btn-info btnposi"> Regresar </a>


    <br><br>

    <a href="/entidad" class="btn btn-success">
      Entidades para credito fiscal
    </a>
    <br> <br>

    <form method="post">
      {{ csrf_field() }}

      <table id="datatable" class="table table-light">
        <thead class="table-dark">
          <tr>
            <th scope="col" class="colorth ocultar" align="center">ID</th>
            <th scope="col" class="colorth" align="center">Fecha de emision</th>
            <th scope="col" class="colorth" align="center">Correlativo</th>
            <th scope="col" class="colorth" align="center">Tipo de Factura</th>
            <th scope="col" class="colorth" align="center">Tipo de Salida</th>
            <th scope="col" class="colorth" align="center">Total</th>
            <th scope="col" class="colorth" align="center">Accion</th>
          </tr>
        </thead>
        <tbody id="tabla">
          @if($salidas)
          @foreach($salidas as $salida)
          <tr>
          <td class="ocultar"align="center">{{$salida->id}}</td>
          <td align="center">{{ date('d/m/Y', strtotime($salida->fecha_emision)) }}</td>
          <td align="center">{{$salida->correlativo_factura}}</td>
          <td align="center">{{$salida->tipo_factura}}</td>
          <td align="center">{{$salida->nombre}}</td>
          <td align="center">{{$salida->total}}</td>
          <td width="30">
          <a href="{{ route('salida.ver', $salida->id) }}" class="detalle view"><i class="detalle fas fa-eye"></i></a>
          </td>
        </tr>

      @endforeach
    @else
    <h6>No existen Salidas</h6>
  @endif
</tbody>
</table>
</form>
</div>
@section('script')
<script src="js/soloDataTable.js"></script>
@endsection
@endsection
