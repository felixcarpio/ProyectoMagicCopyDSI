@extends('layouts.app')
@section('nombre')
Ingresar Pedido
@endsection
@section('links')
  <script src="{{ asset('js/jquery-3.3.1.min.js')}}" ></script>
  <script src="{{ asset('js/jquery.min.js')}}" ></script>
  <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">

<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="stylesheet" href="/css/inventario.css">
<link rel="stylesheet" href="/css/style-mc.css">
@endsection
@section('content')
@auth
  <div class="container">
    <h5>Ingresar Pedido</h5>
    <h6>Codigo de Pedido: P{{$pedido}} </h6>
    <br>
    <p><span style="color:red">*</span> <span  class="campoObligatorio">Campo obligatorio</span></p>
    <form method="POST" action="{{ action('PedidoController@store') }}">
      {{ csrf_field() }}

      <div class="form-group">
        <label for="">Seleccione el Proveedor <span style="color:red">*</span></label>
        <select class="custom-select" name="proveedor">
          <option disabled selected>Lista de Proveedores</option>
          @if($proveedores)
            @foreach ($proveedores as $proveedor)
              <option value="{{ $proveedor->id }}"> {{ $proveedor->nombre }} </option>
            @endforeach
          @else
            <option>No existen proveedores</option>
          @endif
        </select>
      </div>
      {{-- <div class="form-group">
      <label class="col-form-label" for="inputDefault">Codigo de Pedido</label>
      <input type="text" name="codigo" autocomplete="off" class="form-control">
    </div> --}}

    <div class="form-group">
      <label class="col-form-label">Fecha<span style="color:red">*</span> </label>
      <input type="text" name="fecha_solicitud" class="form-control datepicker" placeholder="dd/MM/aaaa">
    </div>

    <br>
    <div class="panel panel-header">

      <div class="row">

      </div></div>
      <div class="panel panel-footer" >
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
                {{-- <input type="text" name="product_name[]" class="form-control" required=""> --}}
              </td>
              <td><input type="number" name="cantidad[]" required="" class="form-control quantity" min="1"></td>
              <td class="remover"><a href="#" class="remove"><i class="fas fa-minus-circle"></i></a></td>
            </tr>
          </tr>
        </tbody>

      </table>
    </div>
  </section>
  <button type="submit" class="btn btn-success">Guardar</button>
  <a href="/verpedidos" class="btn btn-danger">Cancelar</a>
</form>
</div>

<script type="text/javascript">
$('tbody').delegate('.quantity,','keyup',function(){
  var tr=$(this).parent().parent();
  var quantity=tr.find('.quantity').val();
});
function total(){
  var total=0;
  $('.amount').each(function(i,e){
    var amount=$(this).val()-0;
    total +=amount;
  });
  $('.total').html(total+".00 tk");
}
$('.addRow').on('click',function(){
  addRow();
});

function addRow()
{
  var tr='<tr>'+
  '<td>'+
  '<select name="producto[]" class="form-control" required="">'+
  '@if($productos)'+
  '@foreach ($productos as $producto)'+
  '<option value="{{ $producto->id }}"> {{ $producto->nombre }} </option>'+
  '@endforeach'+
  '@else'+
  '<option>No existen Productos</option>'+
  '@endif'+
  '</select>'+
  '<td><input type="number" name="cantidad[]" required="" class="form-control quantity" min="1"></td>'+
  '<td class="remover"><a href="#" class="remove"><i class="fas fa-minus-circle"></i></a></td>'+
  '</tr>';
  $('tbody').append(tr);
};
$('.remove').live('click',function(){
  var last=$('tbody tr').length;
  if(last==1){
    alert("No es posible remover la última fila");
  }
  else{
    $(this).parent().parent().remove();
  }

});
</script> 
@section('script')
<script src="{{ asset('js/jquery-1.12.4.js') }}"></script>
<script src="{{ asset('js/jquery-ui.js') }}"></script>
<script src="{{ asset('js/pedido-inventario.js') }}"></script>
@endsection
@endsection
@endauth
