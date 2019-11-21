@extends('layouts.app')
@section('nombre') Venta
@endsection
@section('links')
<script src="{{ asset('js/jquery-3.3.1.min.js')}}"></script>
<script src="{{ asset('js/jquery.min.js')}}"></script>

<link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('css/salida.css') }}">

@endsection
@section('content')
@auth
<!-- Ingresar Entidad Modal -->
<div class="modal fade" id="ingresarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ingresar Entidad para Crédito Fiscal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ action('EntidadController@storeEnVenta') }}" method="POST" enctype="multipart/form-data" name="formularioIngresarEntidad">
        <div class="modal-body">
          {{ csrf_field() }}

          <p><span style="color:red">*</span> <span class="campoObligatorio">Campo obligatorio</span></p>
          <div class="form-group">
            <label>Nombre de la Entidad <span style="color:red">*</span></label>
            <input type="text" name="nombre" class="form-control" placeholder="Ingrese el nombre de la Entidad">
          </div>

          <div class="form-group">
            <label>NIT <span style="color:red">*</span></label> <span class="aclaracion"> Digitar los 14 dígitos sin guiones </span>
            <input type="text"  pattern="[0-9]{14}" name="nit" required="" id= "nit"  class="form-control" placeholder="Ingrese el NIT de la empresa">
          </div>

          <div class="form-group">
            <label>Número de Registro <span style="color:red">*</span>  <span class="aclaracion"> Digitar los 6 dígitos sin guiones </span> </label>
            <input type="text" pattern="[0-9]{7}" name="numero_registro" required="" id= "registro"  name="numero_registro" class="form-control" placeholder="Ingrese el número de registro">
          </div>

          <div class="form-group">
            <label>Dirección</label>
            <input type="text" name="direccion" class="form-control" placeholder="Ingrese la dirección de la entidad">
          </div>

          <div class="form-group">
            <label>Giro <span style="color:red">*</span></label>
            <input type="text" name="giro" class="form-control" placeholder="Ingrese el giro de la entidad">
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" id="guardar" class="btn btn-success">Guardar</button>
          </div>
      </form>
    </div>
  </div>
</div>
</div>
<!-- Fin Ingresar Entidad Modal -->

<div class="container">
  <h1 class="titulo">Salida de Productos: Venta</h1>
  <h5 align="center"> Salida número {{$salidaActual}}</h5>
  <p><span style="color:red">*</span> <span class="campoObligatorio">Campo obligatorio</span></p>
  <form method="POST" action="{{ action('SalidaController@verificarVenta') }}" name="formulario">
  {{ csrf_field() }}
    <div class="form-group">
      <label class="col-form-label">Seleccione el tipo de salida <span style="color:red">*</span> </label>
      <select class="custom-select" name="tipo" id="tipo">
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
      <label class="col-form-label">Correlativo de factura <span style="color:red">*</span></label>
      <input type="text"  pattern="[0-9]{4}" name="correlativo_factura" 
      id="correlativo_factura"  class="form-control correlativo_factura" placeholder="9999">
    </div>

    <div class="form-group">
      <label class="col-form-label">Fecha <span style="color:red">*</span> </label>
      <input type="text" name="fecha_emision" class="form-control datepicker" placeholder="dd/MM/aaaa">
    </div>

    <div class="form-group">
      <label class="col-form-label">Seleccione la promoción (Si posee) </label>
      <select class="custom-select" name="promocion" id="promocion">
      <option value="Lista de Promociones" selected>Lista de Promociones</option>
        @forelse($promociones as $promocion)
        <option value="{{ $promocion->nombre }}"> {{ $promocion->nombre }} </option>
        @empty
        <option value=""> No hay promociones disponibles</option>
        @endforelse
      </select>
    </div>

    <div class="form-group">
      <label class="col-form-label">Cantidad de promociones</label>
      <input type="number" name="cantidad_promociones" min="1" step="1" max="9999">
    </div>


    <div class="form-group">
      <label class="col-form-label">Seleccione el tipo de factura <span style="color:red">*</span> </label>
      <select class="custom-select" name="factura" id="factura">
        <option disabled selected>Lista de Tipos de Factura</option>
        <option value="Consumidor final">Consumidor Final</option>
        <option value="Sencilla">Sencilla</option>
        <option value="Crédito fiscal">Crédito Fiscal</option>
      </select>
    </div>

    <br>
    
    <div class="form-group" id="especificaciones-factura"></div>

    <br>

    <label> Seleccione los productos </label>
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
            <td><input type="number" name="cantidad[]" required="" class="form-control quantity" min="0" step="1" max="9999"></td>
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
              <td><input type="number" name="cantidad[]" required="" class="form-control quantity" min="1" step="1" max="9999"></td>
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
<script src="{{ asset('js/salida-venta.js') }}"></script>

<script>
  $(function () {
    $('#factura').on('change', function () {
      var factura = $(this).val()
      var codigo
      var Parent = document.getElementById('especificaciones-factura');
      while (Parent.hasChildNodes()) {
        Parent.removeChild(Parent.firstChild);
      }
      if (factura == "Consumidor final") {
        codigo = `<h5>Datos del cliente</h5>
              <label class="datos-cliente">Nombre <span style="color:red">*</span> </label>
              <label class="datos-cliente">Dirección</label>
              <input type="text" name="nombre_comprador" required="" class="form-control datos-cliente">
              <input type="text" name="direccion_comprador" class="form-control datos-cliente">
              <label class="datos-cliente">DUI <span class="aclaracion"> Digitar los 9 dígitos sin guiones </span> </label>
              <label class="datos-cliente">Cuenta</label>
              <input type="text"  pattern="[0-9]{9}" name="dui" id= "dui"  class="form-control datos-cliente" >
              <input type="text" name="cuenta_comprador" class="form-control datos-cliente">`
      } else if (factura == "Sencilla") {
        codigo = `<h5>Datos del cliente</h5>
        <label class="datos-cliente">Nombre <span style="color:red">*</span> </label>
        <input type="text" name="nombre_comprador" required="" class="form-control">`
      } else if (factura == "Crédito fiscal") {
        codigo = `
        <label>Seleccione la empresa <span style="color:red">*</span> </label>
        <select class="custom-select" name="entidad" id="entity">
        @forelse($entidades as $entidad)
        <option value="{{$entidad->nombre}}"> {{$entidad->nombre}} </option>
        @empty
        <option value=""> No hay empresas disponibles para Crédito Fiscal </option>
        @endforelse
      </select>
      <button type="button" class="btn btn-success ingresar-entidad" data-toggle="modal" data-target="#ingresarModal">
    Ingresar Entidad
  </button>`
      }
      $('#especificaciones-factura').append(codigo)
    })
  })
</script>

@endsection

@endsection
@endauth