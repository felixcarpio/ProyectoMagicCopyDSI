@extends('layouts.app')
@section('nombre') Recepción de pedidos @endsection
@section('links')
<script src="{{ asset('js/jquery-3.3.1.min.js')}}"></script>
<script src="{{ asset('js/jquery.min.js')}}"></script>

<link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">

@endsection
@section('content')
@auth
<h5>Recepcion de Pedido</h5>
<br>
<p class="campoObligatorio"><span style="color:red">*</span>: Campo obligatorio</p>
<form method="POST" action="{{ action('RecepcionController@store') }}">
  {{ csrf_field() }}
  <div>
    <div class="form-group">
      <label for="">Seleccione el pedido <span style="color:red">*</span></label>
      <select class="custom-select" name="IdPedido" id="pedidoSelect" onchange="obtenerProductos()">
        <option selected disabled>Pedidos pendientes</option>
        @if($pedidos)
        @foreach ($pedidos as $pedido)
        <option value="{{ $pedido->pedido_id }}"> P{{ $pedido->pedido_id }} </option>
        @endforeach
        @else
        <option>No existen Pedidos</option>
        @endif
      </select>
    </div>

    <div class="form-group">
      <label class="col-form-label">Fecha de Recepción <span style="color:red">*</span> </label>
      <input type="text" name="fecha_recibido" class="form-control datepicker" placeholder="dd/MM/aaaa">
    </div>
    <div class="form-group">
      <label class="col-form-label">Comentarios </label>
      <textarea name="comentario" rows="4" cols="50" class="form-control">
            </textarea>
    </div>
    <label class="col-form-label" for="inputDefault">Productos solicitados</label>
    <table class="table table-active">
      <thead>
        <tr>
          <th scope="col">Producto</th>
          <th scope="col">Costo unitario</th>
        </tr>
      </thead>
      <tbody id="tabla">
      </tbody>
    </table>

  </div>
  <button type="submit" class="btn btn-success">Guardar</button>
  <a href="/verpedidos" class="btn btn-danger">Cancelar</a>
</form>

<script>
  window.obtenerProductos = function() {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      type: 'POST',
      url: '/recepcion',
      data: {
        "pedido": $('#pedidoSelect').val()
      },
      success: function(data) {

        var Parent = document.getElementById('tabla');
        while (Parent.hasChildNodes()) {
          Parent.removeChild(Parent.firstChild);
        }

        data.productos.forEach(function(producto) {
          var codigoHtml = '<tr>' +
            '<td name="producto[]">' + producto.nombre + '</td>' +
            '<td><input class="form-control form-control-sm" name="costo_unitario[]" type="number" id="cantidad" placeholder="Ingrese costo unitario en formato 99.9999" min="0.0000" step="0.0001" required=""></td>' +
            '<tr>';
          $('#tabla').append(codigoHtml);
        });
      }
    });
  }
</script>
@section('script')
<script src="{{ asset('js/jquery-1.12.4.js') }}"></script>
<script src="{{ asset('js/jquery-ui.js') }}"></script>    
<script src="{{ asset('js/conf-datepicker.js') }}"></script>
<script src="{{ asset('js/pedido-inventario.js') }}"></script> 
@endsection
@endsection
@endauth