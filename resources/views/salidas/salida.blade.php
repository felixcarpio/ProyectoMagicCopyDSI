@extends('layouts.app')
@section('nombre') Registrar pedido @endsection
@section('nombre') Salida de producto
@endsection
@section('links')
<script src="{{ asset('js/jquery-3.3.1.min.js')}}"></script>
<script src="{{ asset('js/jquery.min.js')}}"></script>

<link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">

@endsection
@section('content')
@auth
<div class="container">
  <h1 class="titulo">Salida de Productos</h1>
  <h5 align="center"> Salida número {{$salidaActual}}</h5>
  <p><span style="color:red">*</span> <span class="campoObligatorio">Campo obligatorio</span></p>
  <form method="POST" action="{{ action('SalidaController@verificarSalida') }}" name="formulario" enctype="multipart/form-data">
  {{ csrf_field() }}
    <div class="form-group">
      <label class="col-form-label">Seleccione el tipo de salida <span style="color:red">*</span> </label>
      <select class="custom-select" name="tipo" id ="tipo">
        <option disabled selected>Lista de Tipos de Salida</option>
        @if($tipos)
        @foreach ($tipos as $tipo)
        <option value="{{ $tipo->id }}"> {{ $tipo->nombre }} </option>
        @endforeach
        @else
        <option>No existen Tipos de Salida</option>
        @endif
      </select>
    </div>

    <div class="form-group">
      <label class="col-form-label">Fecha <span style="color:red">*</span> </label>
      <input type="text" name="fecha_emision" class="form-control datepicker" placeholder="dd/MM/aaaa">
    </div>

    <div class="form-group">
      <label class="col-form-label">Comentarios </label>
      <textarea name="comentario" rows="4" cols="50" class="form-control">
            </textarea>
    </div>

    <div class="panel panel-footer">
      <table class="table table-bordered">
        <thead class="table-dark">
          <tr>
            <th>Producto</th>
            <th>Cantidad</th>
            <th><a href="#" class="addRow"><i class="fas fa-plus-circle"></i></a></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              <select name="producto[]" class="form-control" required="">
                @if($productos)
                @foreach ($productos as $producto)
                <option value="{{ $producto->id }}"> {{ $producto->nombre }} </option>
                @endforeach
                @else
                <option>No existen Productos</option>
                @endif
              </select>
            </td>
            <td><input type="number" name="cantidad[]" required="" class="form-control quantity" min="1" step="1"></td>
            <td class="remover"><a href="#" class="remove"><i class="fas fa-minus-circle"></i></a></td>
          </tr>
        </tbody>
      </table>
    </div>
    <button type="submit" class="btn btn-success">Guardar</button>
    <a href="/versalidas" class="btn btn-danger">Cancelar</a>
  </form>
</div>

<script type="text/javascript">
  $('.addRow').on('click', function() {
    addRow();
  });

  function addRow() {
    var tr = `<tr>
              <td>
                <select name="producto[]" class="form-control" required="">
                  @if($productos)
                    @foreach ($productos as $producto)
                      <option value="{{ $producto->id }}"> {{ $producto->nombre }} </option>
                    @endforeach
                  @else
                    <option>No existen Productos</option>
                  @endif
                </select>
              </td>
              <td><input type="number" name="cantidad[]" required="" class="form-control quantity" min="1" step="1"></td> 
              <td class="remover"><a href="#" class="remove"><i class="fas fa-minus-circle"></i></a></td>
            </tr>`;
    $('tbody').append(tr);
  };
  $('.remove').live('click', function() {
    var last = $('tbody tr').length;
    if (last == 1) {
      alert("No es posible remover la última fila");
    } else {
      $(this).parent().parent().remove();
    }

  });
</script>

@section('script')

<script src="{{ asset('js/jquery-1.12.4.js') }}"></script>
<script src="{{ asset('js/jquery-ui.js') }}"></script>
<script src="{{ asset('js/salida.js') }}"></script>

@endsection 
@endsection
@endauth 