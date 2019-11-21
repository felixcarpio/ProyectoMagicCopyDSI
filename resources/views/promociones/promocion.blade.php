@extends('layouts.app')
@section('nombre')
Promociones
@endsection
@section('content')
@auth
<!-- Modal Borrar -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header rojo">
        <h5 class="modal-title" id="exampleModalLabel">Eliminar Promoción</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/tipo" method="POST" id="deleteForm">

        {{ csrf_field() }}
        {{ method_field('DELETE') }}

        <div class="modal-body">

          <input type="hidden" name="_method" value="DELETE">
          <p>¿Eliminar Promoción? </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-danger">Eliminar</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Fin Modal Borrar -->

<div class="container">
  <br>
  <h1 class="principal"> Promociones </h1>

  <br><br>

  <a href=" {{ route('promocion.ingresar') }} " class="btn btn-success ingresar">
    Ingresar Promoción
  </a>
  <a href="/" class="btn btn-info"> Regresar </a>
  <br> <br>

  <table id="datatable" class="table table-striped">
    <thead>
      <tr>
        <th scope="col" class="colorth ocultar">ID</th>
        <th scope="col" class="colorth">Nombre</th>
        <th scope="col" class="colorth">Fecha inicial</th>
        <th scope="col" class="colorth">Fecha final</th>
        <th scope="col" class="colorth">Precio</th>
        <th scope="col" class="colorth" width="10">Accion</th>
      </tr>
    </thead>
    <tbody>
      @forelse($promociones as $promocion)
      <tr>
        <td class="ocultar"> {{ $promocion->id }} </td>
        <td> {{ $promocion->nombre }} </td>
        <td> {{ date('d/m/Y', strtotime($promocion->fecha_inicio)) }} </td>
        <td> {{ date('d/m/Y', strtotime($promocion->fecha_fin)) }} </td>
        <td> {{ $promocion->precio_con_descuento }} </td>
        <td width="30">
          <a href=" {{ route('promocion.ver', $promocion->id) }} " class="detalle view"><i class="detalle fas fa-eye"></i></a>
          <a href=" {{ route('promocion.actualizar', $promocion->id) }} " class="edit"><i class="fas fa-edit"></i></a>
          <a href="#" class="delete"><i class="fas fa-trash-alt"></i></a>
        </td>
      </tr>
      @empty
      <h3>No existen Promociones</h3>
      @endforelse

    </tbody>
  </table>
</div>

@section('script')
<script src="js/promocion.js"></script>
@endsection
@endsection
@endauth