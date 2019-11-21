@extends('layouts.app')
@section('nombre')Entidades @endsection

@section('content')
@auth
<!-- Ingresar Modal -->
<div class="modal fade" id="ingresarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ingresar Entidad para Crédito Fiscal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ action('EntidadController@store') }}" method="POST" enctype="multipart/form-data" name="formularioIngresarEntidad">
        <div class="modal-body">
          {{ csrf_field() }}

          <p><span style="color:red">*</span> <span class="campoObligatorio">Campo obligatorio</span></p>
          <div class="form-group">
            <label>Nombre de la Entidad <span style="color:red">*</span></label>
            <input type="text" name="nombre" class="form-control" placeholder="Ingrese el nombre de la Entidad">
          </div>

          <div class="form-group">
            <label>NIT <span style="color:red">*</span></label> <span class="aclaracion"> Digitar los 14 dígitos sin guiones </span>
            <input type="text"  pattern="[0-9]{14}" name="nit" required="" id= "nit"  class="form-control" placeholder="Ingrese el NIT de la empresa">
          </div>

          <div class="form-group">
            <label>Número de Registro <span style="color:red">*</span>  <span class="aclaracion"> Digitar los 6 dígitos sin guiones </span> </label>
            <input type="text" pattern="[0-9]{7}" name="numero_registro" required="" id= "registro"  name="numero_registro" class="form-control" placeholder="Ingrese el número de registro">
          </div>

          <div class="form-group">
            <label>Dirección</label>
            <input type="text" name="direccion" class="form-control" placeholder="Ingrese la dirección de la entidad">
          </div>

          <div class="form-group">
            <label>Giro <span style="color:red">*</span></label>
            <input type="text" name="giro" class="form-control" placeholder="Ingrese el giro de la entidad">
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" id="guardar" class="btn btn-success">Guardar</button>
          </div>
      </form>
    </div>
  </div>
</div>
</div>
<!-- Fin Ingresar Modal -->

<!-- Modal Actualizar -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar Entidad</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/entidad" method="POST" id="editForm" name="formularioActualizarEntidad">
      @method('PUT')
                    @csrf
        <div class="modal-body">
          <div class="form-group">

          <p><span style="color:red">*</span> <span class="campoObligatorio">Campo obligatorio</span></p>
          <div class="form-group">
            <label>Nombre de la Entidad <span style="color:red">*</span></label>
            <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Ingrese el nombre de la Entidad">
          </div>

          <div class="form-group">
            <label>NIT <span style="color:red">*</span></label> <span class="aclaracion"> Digitar los 14 dígitos sin guiones </span>
            <input type="text" pattern="[0-9]{14}" name="nit" id= "nit-actualizar"  class="form-control" placeholder="Ingrese el NIT de la empresa">
          </div>

          <div class="form-group">
            <label>Número de Registro <span style="color:red">*</span>  <span class="aclaracion"> Digitar los 6 dígitos sin guiones </span> </label>
            <input type="text" pattern="[0-9]{7}" name="numero_registro" id= "registro-actualizar"  name="numero_registro" class="form-control" placeholder="Ingrese el número de registro">
          </div>

          <div class="form-group">
            <label>Dirección</label>
            <input type="text" name="direccion" id="direccion" class="form-control" placeholder="Ingrese la dirección de la entidad">
          </div>

          <div class="form-group">
            <label>Giro <span style="color:red">*</span></label>
            <input type="text" name="giro" id="giro" class="form-control" placeholder="Ingrese el giro de la entidad">
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
        <h5 class="modal-title" id="exampleModalLabel">Eliminar Entidad</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/entidad" method="POST" id="deleteForm">

        {{ csrf_field() }}
        {{ method_field('DELETE') }}

        <div class="modal-body">

          <input type="hidden" name="_method" value="DELETE">
          <p>¿Eliminar Entidad de Créditos Fiscales? </p>
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
  <h1 class="principal"> Entidades para Créditos Fiscales</h1>

  <br><br>

  <button type="button" class="btn btn-success ingresar" data-toggle="modal" data-target="#ingresarModal">
    Ingresar Entidad
  </button>
  <a href="/versalidas" class="btn btn-info"> Regresar </a>
  <br> <br>

  <table id="datatable" class="table table-striped">
    <thead>
      <tr>
        <th scope="col" class="colorth ocultar">ID</th>
        <th scope="col" class="colorth">Nombre</th>
        <th scope="col" class="colorth">NIT</th>
        <th scope="col" class="colorth">Número de Registro</th>
        <th scope="col" class="colorth">Dirección</th>
        <th scope="col" class="colorth">Giro</th>
        <th scope="col" class="colorth" width="10">Accion</th>
      </tr>
    </thead>
    <tbody>
      @forelse($entidades as $entidad)
      <tr>
        <td class="ocultar"> {{ $entidad->id }} </td>
        <td> {{ $entidad->nombre }} </td>
        <td> {{ $entidad->nit }} </td>
        <td> {{ $entidad->numero_registro }} </td>
        <td> {{ $entidad->direccion }} </td>
        <td> {{ $entidad->giro }} </td>
        <td width="10">
          <a href="#" class="edit"><i class="fas fa-edit"></i></a>
          <a href="#" class="delete"><i class="fas fa-trash-alt"></i></a>
        </td>
      </tr>
      @empty
      <h3>No existen Entidades para Créditos Fiscales</h3>
      @endforelse

    </tbody>
  </table>
</div>

@section('script')
<script src="js/entidad.js"></script>
@endsection
@endsection
@endauth