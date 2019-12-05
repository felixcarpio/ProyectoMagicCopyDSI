@extends('layouts.app')
@section('nombre')
  Usuarios
@endsection
@section('links')
  <meta charset="utf-8">
  <title>MagicCopy</title>
  <link rel="stylesheet" href="/css/usuarios.css">
@endsection
@section('content')
  @auth
    <!-- MODAL PARA AGREGAR NUEVO USUARIO -->
    <div class="modal fade" id="nuevoUserModal" tabindex="-1" role="dialog" aria-labelledby="nuevoUserModal" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="nuevoUserModal">Ingresar Usuario</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{route('users.store')}}" method="POST">
              {{ csrf_field() }}
              <div class="form-group">
                <label for="username" class="col-form-label">{{ __('Nombre de Usuario:') }}</label>
                <input type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>
                @if ($errors->has('username'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('username') }}</strong>
                  </span>
                @endif
              </div>
              <div class="form-group">
                <label for="nombre" class="col-form-label">{{ __('Nombre:') }}</label>
                <input type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" value="{{ old('nombre') }}" required autofocus>
                @if ($errors->has('nombre'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('nombre') }}</strong>
                  </span>
                @endif
              </div>
              <div class="form-group">
                <label for="apellido" class="col-form-label">{{ __('Apellido:') }}</label>
                <input type="text" class="form-control{{ $errors->has('apellido') ? ' is-invalid' : '' }}" name="apellido" value="{{ old('apellido') }}" required autofocus>
                @if ($errors->has('apellido'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('apellido') }}</strong>
                  </span>
                @endif
              </div>
              <div class="form-group">
                <label for="email" class="col-form-label">{{ __('E-Mail:') }}</label>
                <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                @if ($errors->has('email'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                  </span>
                @endif
              </div>
              <div class="form-group">
                <label for="password" class="col-form-label">{{ __('Contraseña:') }}</label>
                <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                @if ($errors->has('password'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                  </span>
                @endif
              </div>
              <div class="form-group">
                <label for="password-confirm" class="col-form-label">{{ __('Confirmar Contraseña:') }}</label>
                <input type="password" class="form-control" name="password_confirmation" required>
              </div>
              <div class="form-group">
                <label for="direccion_usuario" class="col-form-label">{{ __('Dirección:') }}</label>
                <input type="text" class="form-control{{ $errors->has('direccion_usuario') ? ' is-invalid' : '' }}" name="direccion_usuario" value="{{ old('direccion_usuario') }}" required autofocus>
                @if ($errors->has('direccion_usuario'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('direccion_usuario') }}</strong>
                  </span>
                @endif
              </div>
              <div class="form-group">
                <label for="telefono_usuario" class="col-form-label">{{ __('Teléfono:') }}</label>
                <input type="text" class="form-control{{ $errors->has('telefono_usuario') ? ' is-invalid' : '' }}" name="telefono_usuario" value="{{ old('telefono_usuario') }}" required autofocus>
                @if ($errors->has('telefono_usuario'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('telefono_usuario') }}</strong>
                  </span>
                @endif
              </div>
              <div class="form-group">
                <label for="roles_id" class="col-form-label">{{ __('Rol:') }}</label>
                <select class="custom-select" name="roles_id">
                  <option selected="">Opciones</option>
                  @foreach ($roles as $key => $rol)
                    <option value="{{$rol->id}}">{{$rol->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- MODAL PARA AGREGAR NUEVO USUARIO -->


    <!-- MODAL PARA EDITAR USUARIO -->
    <div class="modal fade" id="editarUserModal" tabindex="-1" role="dialog" aria-labelledby="editarUserModal" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editarUserModal">Actualizar Usuario</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="/index" method="POST" id="editarUserForm" enctype="multipart/form-data">
              @method('PUT')
              @csrf
              <div class="form-group">
                <label for="username" class="col-form-label">{{ __('Nombre de Usuario:') }}</label>
                <input type="text" id="username" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>
                @if ($errors->has('username'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('username') }}</strong>
                  </span>
                @endif
              </div>
              <div class="form-group">
                <label for="nombre" class="col-form-label">{{ __('Nombre:') }}</label>
                <input type="text" id="nombre" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" value="{{ old('nombre') }}" required autofocus>
                @if ($errors->has('nombre'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('nombre') }}</strong>
                  </span>
                @endif
              </div>
              <div class="form-group">
                <label for="apellido" class="col-form-label">{{ __('Apellido:') }}</label>
                <input type="text" id="apellido" class="form-control{{ $errors->has('apellido') ? ' is-invalid' : '' }}" name="apellido" value="{{ old('apellido') }}" required autofocus>
                @if ($errors->has('apellido'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('apellido') }}</strong>
                  </span>
                @endif
              </div>
              <div class="form-group">
                <label for="email" class="col-form-label">{{ __('E-Mail:') }}</label>
                <input type="email" id="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                @if ($errors->has('email'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                  </span>
                @endif
              </div>
              <div class="form-group">
                <label for="direccion_usuario" class="col-form-label">{{ __('Dirección:') }}</label>
                <input type="text" id="direccion_usuario" class="form-control{{ $errors->has('direccion_usuario') ? ' is-invalid' : '' }}" name="direccion_usuario" value="{{ old('direccion_usuario') }}" required autofocus>
                @if ($errors->has('direccion_usuario'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('direccion_usuario') }}</strong>
                  </span>
                @endif
              </div>
              <div class="form-group">
                <label for="telefono_usuario" class="col-form-label">{{ __('Teléfono:') }}</label>
                <input type="text" id="telefono_usuario" class="form-control{{ $errors->has('telefono_usuario') ? ' is-invalid' : '' }}" name="telefono_usuario" value="{{ old('telefono_usuario') }}" required autofocus>
                @if ($errors->has('telefono_usuario'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('telefono_usuario') }}</strong>
                  </span>
                @endif
              </div>
              <div class="form-group">
                <label for="roles_id" class="col-form-label">{{ __('Rol:') }}</label>
                <select class="custom-select" id="roles_id" name="roles_id">
                  <option selected="">Opciones</option>
                  @foreach ($roles as $key => $rol)
                    <option value="{{$rol->id}}">{{$rol->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success">Actualizar Usuario</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- MODAL PARA EDITAR USUARIO -->


    <!-- MODAL PARA ELIMINAR ROL -->
    <div class="modal fade" id="deleteUserModal" tabindex="-1" role="dialog" aria-labelledby="deleteUserModal" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header rojo">
            <h5 class="modal-title" id="deleteUserModal">Eliminar Rol</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="/index" method="POST" id="deleteUserForm">

            {{ csrf_field() }}
            {{ method_field('DELETE') }}

            <div class="modal-body">
              <input type="hidden" name="_method" value="DELETE">
              <p>Esta seguro de eliminar el usuario? </p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-danger">Si! Eliminar Usuario</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- MODAL PARA ELIMINAR ROL -->

    <div class="container">
      <br>
      <div class="text-center">
        <h1 class="principal">Listado de Usuarios</h1>
      </div>
      <br> <br>

      <button type="button" class="btn btn-success ingresar" data-toggle="modal" data-target="#nuevoUserModal">
        Ingresar Usuario
      </button>
      <a href="/" class="btn btn-info btnposi"> Regresar </a>
      <br>
      <br>
      <a class="btn btn-success btn-recepcion" href="{{route('roles.index')}}">Roles</a>
    </div>
    <br>
    <div class="container">
      <table id="datatable" class="table table-hover">
        <thead class="table-dark">
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre de Usuario</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">Email</th>
            <th scope="col">Dirección</th>
            <th scope="col">Teléfono</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($User as $key => $users)
            <tr>
              <td>{{$users->id}}</td>
              <td>{{$users->username}}</td>
              <td>{{$users->nombre}}</td>
              <td>{{$users->apellido}}</td>
              <td>{{$users->email}}</td>
              <td>{{$users->direccion_usuario}}</td>
              <td>{{$users->telefono_usuario}}</td>
              
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
    <script src="js/actualizarUsuario.js"></script>
  @endsection

  @endauth
@endsection
