@extends('layouts.app')
@section('nombre')
Pedidos
@endsection
@section('links')
  <link rel="stylesheet" href="/css/inventario.css">
@endsection
@section('content')
@auth
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header rojo">
        <h5 class="modal-title" id="exampleModalLabel">Eliminar Pedido</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/eliminarpedido" method="POST" id="deleteForm">

        {{ csrf_field() }}
        {{ method_field('DELETE') }}

        <div class="modal-body">

          <input type="hidden" name="_method" value="DELETE">
          <p>¿Eliminar Pedido? </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-danger">Eliminar</button>
        </div>
      </form>
    </div>
  </div>
</div>

  <div class="container">
    <h1 class="titulo"> Pedidos </h1>
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

    <a href="/pedido" class="btn btn-success ingresar">
      Registrar Pedido
    </a>

    <a class="btn btn-success btn-recepcion ingresar" href="/recepcion">
      Recepcion de pedido
    </a>

    <a href="/inventario" class="btn btn-info btnposi"> Regresar </a>


    <br><br>

    <form method="post">
      {{ csrf_field() }}

      <table id="datatable" class="table table-light">
        <thead class="table-dark">
          <tr align="center">
            <th class="">ID</th>
            <th scope="col" class="colorth" align="center">Fecha solicitud</th>
            <th scope="col" class="colorth" align="center">Fecha de recepcion</th>
            <th scope="col" class="colorth" align="center">Numero de pedido</th>
            <th scope="col" class="colorth" align="center">Acción</th>
          </tr>
        </thead>
        <tbody id="tabla">
          @if($pedidos)
          @foreach($pedidos as $pedido)
          <tr>
          <td class="">{{$pedido->id}}</td>
          <td align="center"> {{ date('d/m/Y', strtotime($pedido->fecha_solicitud)) }}</td>
          <td align="center">{{ date('d/m/Y', strtotime($pedido->fecha_recibido)) }}</td>
          <td align="center">{{$pedido->codigo}}</td>
          <td width="30">
          <a href=" {{ route('pedido.ver', $pedido->id) }} " class="detalle view"><i class="detalle fas fa-eye"></i></a>
          @if(!$pedido->fecha_recibido)
          <a href="#" class="delete"><i class="fas fa-trash-alt"></i></a>
          @endif
          </td>
        </tr>

      @endforeach
    @else
    <h6>No existen Pedidos</h6>
  @endif
</tbody>
</table>
</form>
</div>
@section('script')
<script src="js/verpedidos.js"></script>
@endsection
@endsection
@endauth
