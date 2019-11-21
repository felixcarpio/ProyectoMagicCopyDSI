@extends('layouts.appticket')
@section('nombre')
  Categoria
@endsection
@section('content')
    @auth
<!-- add categoria-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Ingresar Categoría</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="{{ action('CategoriaController@store') }}" method="POST">
                  <div class="modal-body">
                  <p><span style="color:red">*</span> <span class="campoObligatorio">Campo obligatorio</span></p>
                    {{ csrf_field() }}

                    <div class="form-group">
            
                      <label>Nombre <span style="color:red">*</span></label>
                      <input type="text" name="nombre"  class="form-control" placeholder="Ingrese la categoria">
                    
                      <label>Descripción <span style="color:red">*</span></label>
                      <input type="text" name="descripcion"  class="form-control" placeholder="Ingrese una Descripción">

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

<!--Start Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Actualizar Máquina</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="/marca" method="POST" id="editForm">
                  <div class="modal-body">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                      
                    <label>Categoría <span style="color:red">*</span></label>
                      <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ingrese la nueva categoría de la maquina">

                      <label>Descripción <span style="color:red">*</span></label>
                      <input type="text" name="descripcion" id="descripcion" class="form-control" placeholder="Ingrese una descripción de la maquina">

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

<h1 class="titulo"> Listado Categoria </h1>
    <br>

    <input type="text" id="buscar" class="buscador sombra" placeholder="Buscar Categoria...">



<button type="button" class="btn btn-success ingresar" data-toggle="modal" data-target="#exampleModal">
            Ingresar Categoría
          </button>
          <br> <br>

    <a href="/maquina" class="btn btn-info btnposi"> Regresar </a>

<table id="datatable" class="table table-striped">
    <thead>
      <tr>
        <th scope="col" class="colorth ocultar">ID</th>
        <th scope="col" class="colorth" width='25%'>Categoría</th>             
          <th scope="col" class="colorth" width='40%'>Descripción</th>
        <th scope="col" class="colorth" width="10%">Acción</th>
      </tr>
    </thead>
    <tbody>
      @forelse($categorias as $categoria)
      <tr>
        <td class="ocultar"> {{ $categoria->id }} </td>
        <td width='25%'> {{ $categoria->nombre}} </td>
        <td width='40%'> {{ $categoria->descripcion}} </td>
        <td width="10%">
          <a href="#" class="edit"><i class="fas fa-edit"></i></a>
        </td>
      </tr>
      @empty
      <h3>No existen Categorias</h3>
      @endforelse

    </tbody>
  </table>

      @section('script')
        <script src="js/categoria.js"></script>
        <script src="js/buscar.js"></script>
      @endsection
  @endauth
@endsection