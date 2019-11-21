@extends('layouts.app')
@section('nombre')
  Reservas
@endsection
@section('links')
  <meta charset="utf-8">
  <title>MagicCopy</title>
  <link rel="stylesheet" href="/css/producto.css">

@endsection
@section('content')
  @auth

<!--Start Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cambiar Estado</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/reservas" method="POST" id="editForm" enctype="multipart/form-data">
        <div class="modal-body">
          @method('PUT')
          @csrf


          <div class="form-group">
            <label>Estado</label>
            <select name="estados_id" id="estados_id[]" class="form-control">
              @foreach ($estados as $estado)
                  <option value="{{ $estado->id }}">{{ $estado->nombre }}</option>
              @endforeach

            </select>
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
      <h5 class="modal-title" id="exampleModalLabel">Eliminar Reserva</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <form action="/reserva" method="POST" id="deleteForm">

      {{ csrf_field() }}
      {{ method_field('DELETE') }}

      <div class="modal-body">

          <input type="hidden" name="_method" value="DELETE">
            <p>Esta seguro de eliminar la reserva? </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-danger">Si, Eliminar Reserva</button>
      </div>
    </form>
  </div>
</div>
</div>
<!-- End Delete Modal -->

  <div class="container">
    <br>
      <h1 class="principal"> Reservas </h1>

      {{-- <input type="text" id="buscar" class="buscador sombra" placeholder="Buscar Producto..."> --}}

      <br><br>



      <button type="button" class="btn btn-success ingresar" data-toggle="modal" data-target="#exampleModal">
        Ingresar Reserva
      </button>
      <a href="#" class="btn btn-info"> Regresar </a>
      <br><br>

                <table id="datatable" class="table table-striped">
        <thead>
          <tr>
            <th scope="col" class="colorth ocultar">ID</th>
            <th scope="col" class="colorth">#Reserva</th>
            <th scope="col" class="colorth">Nombre Cliente</th>
            <th scope="col" class="colorth">Fecha</th>
            <th scope="col" class="colorth">Estado</th>
            <th scope="col" class="colorth">Accion</th>
          </tr>
        </thead>
        <tbody>
              @foreach ($reservas as $reserva)
            <tr>

              <td class="ocultar"> {{ $reserva->id }} </td>
              <td> {{ $reserva->codigo_reserva }} </td>
              <td> {{ $reserva->nombre }} </td>
              <td> {{ $reserva->fecha_solicitud }} </td>
              @foreach ($estados as $estado)
                @if ($reserva->estado_reserva_id == $estado->id)
                   <td> {{ $estado->nombre }} </td>
                @endif
              @endforeach
              <td>
                <a href="{{ route('reserva.mostrar', $reserva->id) }}" class="detalle view"><i class="fas fa-eye"></i></a>
                <a href="#"><i class="detalle fas fa-file-pdf"></i></a>
                <a href="#" class="edit actualizar"><i class="fas fa-edit"></i></a>
                <a href="#" class="delete borrar"><i class="fas fa-trash-alt"></i></a>
               </td>
             </tr>
            @endforeach
        </tbody>
      </table>
  </div>
@section('script')
  <script src="js/reservas.js"></script>
@endsection

@endauth 

@endsection
