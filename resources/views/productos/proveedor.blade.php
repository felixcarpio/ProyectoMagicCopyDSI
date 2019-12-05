@extends('layouts.app')
@section('nombre')
  Producto
@endsection
@section('links')
  <meta charset="utf-8">
  <title>MagicCopy</title>
  <link rel="stylesheet" href="/css/producto.css">

@endsection
@section('content')
  {{-- @auth --}}

    <div class="container">
      <br>
      <h1 class="principal"> Proveedores </h1>
      <div class="row justify-content-center">
        <div class="col-md-8">
          <!--Start Add Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Ingresar Proveedor</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="{{ action('ProveedorController@store') }}" method="POST">
                  <div class="modal-body">
                    {{ csrf_field() }}

                    <div class="form-group">
                      <label>Nombre del Proveedor*</label>
                      <input type="text" name="nombre" class="form-control" placeholder="Ingrese el nombre del proveedor">
                    </div>

                    <div class="form-group">
                      <label>Direccion</label>
                      <input type="text" name="direccion" class="form-control" placeholder="Ingrese la direccion del proveedor">
                    </div>

                    <div class="form-group">
                      <label>Telefono</label>
                      <input type="tel" pattern="[0-9]{8}" name="telefono" class="form-control" placeholder="Ingrese el telefono del proveedor">
                    </div>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

          {{-- End Add Modal --}}

          <!--Start Edit Modal -->
          <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Actualizar Proveedor</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="/proveedor" method="POST" id="editForm">
                  <div class="modal-body">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                      <label>Nombre del Proveedor</label>
                      <input type="text" name="nombre" id='nombre' class="form-control" placeholder="Ingrese el nombre del proveedor">
                    </div>

                    <div class="form-group">
                      <label>Direccion</label>
                      <input type="text" name="direccion" id='direccion' class="form-control" placeholder="Ingrese la direccion del proveedor">
                    </div>

                    <div class="form-group">
                      <label>Telefono</label>
                      <input type="tel" pattern="[0-9]{8}" name="telefono" id="telefono" class="form-control" placeholder="Ingrese el telefono del proveedor">
                    </div>


                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                      <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

          {{-- End Edit Modal --}}

          <!-- Start Delete Modal -->
          <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header rojo">
                  <h5 class="modal-title" id="exampleModalLabel">Eliminar Proveedor</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="/proveedor" method="POST" id="deleteForm">

                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}

                  <div class="modal-body">

                    <input type="hidden" name="_method" value="DELETE">
                    <p>Esta seguro de eliminar el proveedor? </p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-danger">Si, eliminar Proveedor</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- End Delete Modal -->

          <button type="button" class="btn btn-success ingresar" data-toggle="modal" data-target="#exampleModal">
            Ingresar Proveedor
          </button>
          <a href="/producto" class="btn btn-info"> Regresar </a>
          <br><br>

          <table id="datatable" class="table table-striped">
            <thead>
              <tr>
                <th scope="col" class="colorth ocultar">ID</th>
                <th scope="col" class="colorth">Nombre</th>
                <th scope="col" class="colorth">Direccion</th>
                <th scope="col" class="colorth">Telefono</th>
                <th scope="col" class="colorth">Accion</th>
              </tr>
            </thead>
            {{-- <tfoot>
            <tr>
            <th scope="col" class="colorth">ID</th>
            <th scope="col" class="colorth">Nombre</th>
          </tr>
        </tfoot> --}}
        <tbody>
          @foreach ($proveedor as $proveedores)
            <tr>
              <th class="ocultar"> {{ $proveedores->id }} </th>
              <th> {{ $proveedores->nombre }} </th>
              <td> {{ $proveedores->direccion }} </td>
              <td> {{ $proveedores->telefono }} </td>

              <td>
                <a href="#" class="edit actualizar"><i class="fas fa-edit"></i></a>
                <a href="#" class="delete borrar"><i class="fas fa-trash-alt"></i></a>
              </td>
            </tr>
          @endforeach

        </tbody>
      </table>



    </div>
  </div>
</div>

@section('script')
  <script src="js/actualizarProveedor.js"></script>
@endsection

{{-- @endauth --}}

@endsection
