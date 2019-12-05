@extends('layouts.app')
@section('nombre')
  Cotizaciones
@endsection
@section('links')
  <meta charset="utf-8">
  <title>MagicCopy</title>
  <link rel="stylesheet" href="/css/producto.css">

@endsection
@section('content')
  {{-- @auth --}}

<!-- Start Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header rojo">
      <h5 class="modal-title" id="exampleModalLabel">Eliminar Cotizacion</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <form action="/cotizacion" method="POST" id="deleteForm">

      {{ csrf_field() }}
      {{ method_field('DELETE') }}

      <div class="modal-body">

          <input type="hidden" name="_method" value="DELETE">
            <p>Esta seguro de eliminar la cotizacion? </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-danger">Si, Eliminar Cotizacion</button>
      </div>
    </form>
  </div>
</div>
</div>
<!-- End Delete Modal -->

  <div class="container">
    <br>
      <h1 class="principal"> Cotizaciones </h1>

      {{-- <input type="text" id="buscar" class="buscador sombra" placeholder="Buscar Producto..."> --}}

      <br><br>



      <a href="/libreria" class="btn btn-success ingresar" >
        Ingresar Cotizacion
      </a>
      <a href="/" class="btn btn-info"> Regresar </a>
      <br> <br>


      <table id="datatable" class="table table-striped">
        <thead>
          <tr>
            <th scope="col" class="colorth ocultar">ID</th>
            <th scope="col" class="colorth">Codigo</th>
            <th scope="col" class="colorth">Nombre</th>
            <th scope="col" class="colorth">Correo</th>
            <th scope="col" class="colorth">Numero Telefonico</th>
            <th scope="col" class="colorth">Fecha Solicitud</th>
            <th scope="col" class="colorth">Tipo de Cotizacion</th>
            <th scope="col" class="colorth">Accion</th>
          </tr>
        </thead>
        <tbody>
              @foreach ($cotizaciones as $cotizacion)
            <tr>

              <td class="ocultar"> {{ $cotizacion->id }} </td>
              <td> {{ $cotizacion->codigo }} </td>
              <td> {{ $cotizacion->nombre_contacto }} </td>
              <td> {{ $cotizacion->correo_contacto }} </td>
              <td> {{ $cotizacion->telefono }} </td>
              <td>{{ date('d/m/Y', strtotime($cotizacion->fecha_solicitud)) }}</td>
              <td>Cotizaciones</td>
              <td>
                <a href="{{ route('cotizacion.mostrar', $cotizacion->codigo) }}" class="detalle view"><i class="fas fa-eye"></i></a>
                <a href="#" class="delete borrar"><i class="fas fa-trash-alt"></i></a>
               </td>
             </tr>
            @endforeach
            @foreach ($eventos as $evento)
          <tr>

            <td class="ocultar"> {{ $evento->id }} </td>
            <td> {{ $evento->codigo }} </td>
            <td> {{ $evento->nombre_cliente }} </td>
            <td> {{ $evento->correo }} </td>
            <td> {{ $evento->num_telefono }} </td>
            <td>{{ $evento->fecha_evento }}</td>
            <td> Eventos </td>
            <td>
              <a href="{{ route('evento.mostrar', $evento->codigo) }}" class="detalle view"><i class="fas fa-eye"></i></a>
              <a href="#" class="delete borrar"><i class="fas fa-trash-alt"></i></a>
             </td>
           </tr>
          @endforeach
        </tbody>
      </table>
  </div>
@section('script')
  <script src="js/cotizaciones.js"></script>]
@endsection

 {{-- @endauth  --}}

@endsection
