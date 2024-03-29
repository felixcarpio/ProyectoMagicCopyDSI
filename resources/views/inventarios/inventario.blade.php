@extends('layouts.app')
@section('nombre')
Inventario
@endsection
@section('links')
  <meta charset="utf-8">
  <title>MagicCopy</title>
  <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css"> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="/css/inventario.css">
@endsection
@section('content')
@auth
  <div class="container">
    <h1 class="titulo"> Inventario de {{$nombre}} </h1>
    <br>
    <a href="/verpedidos" class="btn btn-success ingresar">
     Pedidos
    </a>

   

    <a href="/" class="btn btn-info btnposi"> Regresar </a>


    <br><br>


    <a href="/versalidas" class="btn btn-success">
      Salidas
    </a>

    <br>
    <br>
    <br>

    <form method="post" action="{{ action('InventarioController@inventarioDelProducto') }}">
      {{ csrf_field() }}

      <div class="one">
      <label>Seleccione el Producto</label>
      <br>
      <select class="custom-select" name="producto" id="selectProductos">
        <option disabled selected> Lista de Productos</option>
        @if($productos)
          @foreach ($productos as $producto)
            <option> {{ $producto->nombre }} </option>
          @endforeach
        @else
          <option>No existen Productos</option>
        @endif
      </select>
      </div>
      <br><br>
      <div class="two">
      <button type="submit" class="btn btn-success" id="btnProductos">Obtener Inventario</button>
      </div>
      <br><br>
      <table id="datatable" class="table table-light">

        <thead class="table-dark">
          <tr align="center"> 
            <th scope="col" class="colorth ocultar" align="center">Fecha</th>
            <th scope="col" class="colorth" align="center">Fecha</th>
            <th scope="col" class="colorth" align="center">Producto</th>
            <th scope="col" class="colorth" align="center">Cantidad</th>
            <th scope="col" class="colorth" align="center">Existencias</th>
            <th scope="col" class="colorth" align="center">Costo unitario</th>
            <th scope="col" class="colorth" align="center">Total</th>
          </tr>
        </thead>
        <tbody id="tabla">
          @if($inventario)
          @foreach($inventario as $clave => $valor)
          <tr>
          <td align="center" class="ocultar">{{ date('d/m/Y h:i:s', strtotime($inventario[$clave]->fechaCreacion)) }}</td>
          <td align="center">{{ date('d/m/Y', strtotime($inventario[$clave]->fecha)) }}</td>
          <td align="center">{{$inventario[$clave]->nombre}}</td>
          <td align="center"> <label class="cantidad{{$clave}}">{{$inventario[$clave]->cantidad}}</label> </td>
          <td align="center"> <label for="">{{$inventario[$clave]->existencias}}</label></td>
          <td align="center"> <label class="costo{{$clave}}">{{$inventario[$clave]->costo}}</label> </td>
          <td align="center"> <label class="label{{$clave}} ">{{ number_format($inventario[$clave]->existencias * $inventario[$clave]->costo, 2) }}</label> </td>
        </tr>
      @endforeach
    @else
    <h6>No existen datos de inventario</h6>
  @endif
</tbody>
</table>
</form>
</div>

@section('script')
<script src="js/soloDataTable.js"></script>
@endsection
@endsection
@endauth
