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
      <h1 class="principal"> Marcas </h1>
      <br> <br>
      <div class="row justify-content-center">
        <div class="col-md-8">
          <!--Start Add Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Ingresar Marca</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="{{ action('MarcaController@store') }}" method="POST">
                  <div class="modal-body">
                    {{ csrf_field() }}

                    <div class="form-group">
                      <label>Nombre de la Marca</label>
                      <input type="text" name="nombre" class="form-control" placeholder="Ingrese el nombre de la marca">
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
                  <h5 class="modal-title" id="exampleModalLabel">Actualizar Marca</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="/marca" method="POST" id="editForm">
                  <div class="modal-body">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                      <label>Nombre de la Marca</label>
                      <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ingrese el nombre de la marca">
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

<!-- End Edit Modal -->

          <button type="button" class="btn btn-success ingresar" data-toggle="modal" data-target="#exampleModal">
            Ingresar Marca
          </button>
          <a href="/producto" class="btn btn-info"> Regresar </a>
          <br><br>

          <table id="datatable" class="table table-striped">
            <thead>
              <tr>
                <th scope="col" class="colorth ocultar">ID</th>
                <th scope="col" class="colorth">Nombre</th>
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
          @foreach ($marca as $marcas)
            <tr>
              <th class="ocultar"> {{ $marcas->id }} </th>
              <td> {{ $marcas->nombre }} </td>

              <td>
                <a href="#" class="edit actualizar"><i class="fas fa-edit"></i></a>
                <a href="#" class="delete borrar"><i class="fas fa-trash-alt"></i></a>
              </td>
            </tr>
            <!-- Start Delete Modal -->
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header rojo">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar Marca</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form action="/marca" method="POST" id="deleteForm">

                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    <div class="modal-body">

                      <input type="hidden" name="_method" value="DELETE">
                      <p>Esta seguro de eliminar la marca? </p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                      <button href="{{ route('marca.eliminar', $marcas->id) }}" type="submit" class="btn btn-danger">Si, eliminar Marca</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- End Delete Modal -->
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

@section('script')
  <script src="js/actualizarMarca.js"></script>
@endsection
{{-- @endauth --}}
@endsection
