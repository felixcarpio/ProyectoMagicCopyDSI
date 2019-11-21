@extends('layouts.app')
@section('nombre')Tipos @endsection

@section('scripts')


@endsection
@auth

<!-- Modal Ingresar -->
<div class="modal fade" id="ingresarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ingresar Tipo de Salida</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ action('TipoController@store') }}" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          {{ csrf_field() }}

          <p><span style="color:red">*</span> <span class="campoObligatorio">Campo obligatorio</span></p>
          <div class="form-group">
            <label>Nombre del Tipo de Salida <span style="color:red">*</span></label>
            <input type="text" name="nombre" class="form-control" placeholder="Ingrese el nombre del Tipo de Salida">
          </div>

          <div class="form-group">
            <label>Descripcion <span style="color:red">*</span></label>
            <input type="text" name="descripcion" class="form-control" placeholder="Ingrese descripcion del Tipo de Salida">
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-success">Guardar</button>
          </div>
      </form>
    </div>
  </div>
</div>
</div>
<!-- Fin Modal Ingresar -->

<!-- Modal Actualizar -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar Tipo de Salida</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/tipo" method="POST" id="editForm">
      @method('PUT')
                    @csrf
        <div class="modal-body">
          <div class="form-group">

          <p><span style="color:red">*</span> <span class="campoObligatorio">Campo obligatorio</span></p>
          <div class="form-group">
            <label>Nombre del Tipo de Salida <span style="color:red">*</span></label>
            <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Ingrese el nombre del producto">
          </div>

          <div class="form-group">
            <label>Descripcion <span style="color:red">*</span></label>
            <input type="text" name="descripcion" class="form-control" id="descripcion" placeholder="Ingrese descripcion del producto">
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-success">Actualizar</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
</div>
<!-- Fin Modal Actualizar -->

<!-- Modal Borrar -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header rojo">
        <h5 class="modal-title" id="exampleModalLabel">Eliminar Tipo de Salida</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/tipo" method="POST" id="deleteForm">

        {{ csrf_field() }}
        {{ method_field('DELETE') }}

        <div class="modal-body">

          <input type="hidden" name="_method" value="DELETE">
          <p>¿Eliminar Tipo de Salida? </p>
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

<!-- Tabla de datos -->
<div class="container">
  <br>
  <h1 class="principal"> Tipos de Salida </h1>

  <br><br>

  <button type="button" class="btn btn-success ingresar" data-toggle="modal" data-target="#ingresarModal">
    Ingresar Tipo de Salida
  </button>
  <a href="/versalidas" class="btn btn-info"> Regresar </a>
  <br> <br>

  <table id="datatable" class="table table-striped">
    <thead>
      <tr>
        <th scope="col" class="colorth ocultar">ID</th>
        <th scope="col" class="colorth">Nombre</th>
        <th scope="col" class="colorth">Descripcion</th>
        <th scope="col" class="colorth" width="5%">Accion</th>
      </tr>
    </thead>
    <tbody>
      @forelse($tipos as $tipo)
      <tr>
        <td class="ocultar"> {{ $tipo->id }} </td>
        <td> {{ $tipo->nombre }} </td>
        <td> {{ $tipo->descripcion }} </td>
        <td width="" align="center">
          <a href="#" class="edit"><i class="fas fa-edit"></i></a>
        </td>
      </tr>
      @empty
      <h3>No existen Tipos de Salida</h3>
      @endforelse

    </tbody>
  </table>
</div>

@section('script')
<script src="js/tipo.js"></script>
@endsection
@endsection
@endauth