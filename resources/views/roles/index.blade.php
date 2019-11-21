@extends('layouts.app')
@section('nombre')
  Roles
@endsection
@section('links')
  <meta charset="utf-8">
  <title>MagicCopy</title>
  <link rel="stylesheet" href="/css/usuarios.css">
@endsection
@section('content')
  @auth
    <!-- MODAL PARA AGREGAR NUEVO ROL -->
    <div class="modal fade" id="nuevoRolModal" tabindex="-1" role="dialog" aria-labelledby="nuevoRolModal" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="nuevoRolModal">Ingresar Rol</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{route('roles.store')}}" method="POST">
              {{ csrf_field() }}
              <div class="form-group">
                <label class="col-form-label" for="inputDefault">Nombre de Rol:</label>
                <input type="text" name="nombre" class="form-control" placeholder="Nombre">
              </div>
              <div class="form-group">
                <label class="col-form-label" for="inputDefault">Descripción de Rol:</label>
                <input type="text" name="descripcion" class="form-control" placeholder="Descripción">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success">Guardar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- MODAL PARA AGREGAR NUEVO ROL -->

    <!-- MODAL PARA EDITAR ROL -->
    <div class="modal fade" id="editarRolModal" tabindex="-1" role="dialog" aria-labelledby="editarRolModal" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editarRolModal">Actualizar Rol</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="/index" method="POST" id="editarRolForm" enctype="multipart/form-data">
              @method('PUT')
              @csrf
              <div class="form-group">
                <label class="col-form-label" for="inputDefault">Nombre de Rol:</label>
                <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre">
              </div>
              <div class="form-group">
                <label class="col-form-label" for="inputDefault">Descripción de Rol:</label>
                <input type="text" id="descripcion" name="descripcion" class="form-control" placeholder="Descripción">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success">Actualizar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- MODAL PARA EDITAR ROL -->


    <!-- MODAL PARA ELIMINAR ROL -->
    <div class="modal fade" id="deleteRolModal" tabindex="-1" role="dialog" aria-labelledby="deleteRolModal" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header rojo">
            <h5 class="modal-title" id="deleteRolModal">Eliminar Rol</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="/index" method="POST" id="deleteRolForm">

            {{ csrf_field() }}
            {{ method_field('DELETE') }}

            <div class="modal-body">
              <input type="hidden" name="_method" value="DELETE">
              <p>Esta seguro de eliminar el rol? </p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-danger">Si! Eliminar Rol</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- MODAL PARA ELIMINAR ROL -->

    <div class="container">
    <br>
    <div class="text-center">
      <h1 class="principal">Listado de Roles</h1>
    </div>
    <br> <br>
    <!-- Button trigger modal -->
      <button type="button" class="btn btn-success ingresar" data-toggle="modal" data-target="#nuevoRolModal">
        Ingresar Rol
      </button>
      <a href="/" class="btn btn-info btnposi"> Regresar </a>
    </div>
    <br>
    <div class="container">
      <table id="datatable" class="table table-hover">
        <thead class="table-dark">
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre</th>
            <th scope="col">Descripción</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($Rol as $key => $roles)
            <tr>
              <td>{{$roles->id}}</td>
              <td>{{$roles->nombre}}</td>
              <td>{{$roles->descripcion}}</td>
              <td>
                <a href="#" class="edit actualizar"><i class="fas fa-edit"></i></a>
                <a href="#" class="delete borrar"><i class="fas fa-trash-alt"></i></a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    @section('script')
    <script src="js/actualizarRol.js"></script>
    @endsection
  @endauth
@endsection
