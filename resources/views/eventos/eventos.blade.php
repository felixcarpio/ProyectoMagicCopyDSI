@extends('layouts.app')
@section('nombre')
  Evento
@endsection
@section('links')
  <meta charset="utf-8">
  <title>MagicCopy</title>
  <link rel="stylesheet" href="/css/producto.css">

@endsection
@section('content')
  {{-- @auth  --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ingresar Evento</h5>
        <p><span style="color:red"> *</span> <span class="campoObligatorio">Campo obligatorio</span></p>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ action('ImagenEventoController@store') }}" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          {{ csrf_field() }}

            <div class="form-group">
              <label>Nombre del Evento<span style="color:red">*</span></label>
              <input type="text" name="nombre" class="form-control" placeholder="Ingrese el nombre del evento">
            </div>
            
            <div class="form-group">
              <label>Imagen</label>
              <input type="file" name="imagen"  placeholder="Ingrese el nombre de la imagen">
            </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>
</div>

{{-- End Add Modal --}}

<!--Start Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar Evento</h5>
        <p><span style="color:red"> *</span> <span class="campoObligatorio">Campo obligatorio</span></p>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/imagenes_evento" method="POST" id="editForm" enctype="multipart/form-data">
        <div class="modal-body">
          @method('PUT')
          @csrf
          <div class="form-group">
            <label>Nombre del Evento<span style="color:red"> *</span></label>
            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ingrese el nombre del evento">
          </div>

          <div class="form-group">
            <label>Imagen</label>
            <input type="file" name="imagen" id="imagen"  placeholder="Ingrese el nombre de la imagen">
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
      <h5 class="modal-title" id="exampleModalLabel">Eliminar Evento</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <form action="/imagenes_evento" method="POST" id="deleteForm">

      {{ csrf_field() }}
      {{ method_field('DELETE') }}

      <div class="modal-body">

          <input type="hidden" name="_method" value="DELETE">
            <p>Esta seguro de eliminar el evento? </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-danger">Eliminar Evento</button>
      </div>
    </form>
  </div>
</div>
</div>
<!-- End Delete Modal -->

  <div class="container">
    <br>
      <h1 class="principal"> Evento </h1>

      <br><br>



      <button type="button" class="btn btn-success ingresar" data-toggle="modal" data-target="#exampleModal">
        Ingresar Evento
      </button>
      <a href="/" class="btn btn-info"> Regresar </a>
      <br> <br>

                <table id="datatable" class="table table-striped">
        <thead>
          <tr>
            <th scope="col" class="colorth ocultar">ID</th>
            <th scope="col" class="colorth">Nombre</th>
            <th scope="col" class="colorth">Imagen</th>
            <th scope="col" class="colorth">Accion</th>
          </tr>
        </thead>
        <tbody>
              @foreach ($imagenesevento as $imagenevento)
            <tr>

              <td class="ocultar"> {{ $imagenevento->id }} </td>
              <td> {{ $imagenevento->nombre }} </td>        
              <td>
                  <img style="width:70px;height:70px" class="imagen" src="images/imageneseventos/{{$imagenevento->imagen}}" alt="">
              </td>
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
  <script src="js/imagenesEvento.js"></script>
@endsection

{{-- @endauth --}}

@endsection
