@extends('layouts.appticket')
@section('nombre')
Ingresar Ticket
@endsection
@section('links')
<script src="{{ asset('js/jquery-3.3.1.min.js')}}"></script>
<script src="{{ asset('js/jquery.min.js')}}"></script>
<link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}}
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"> --}}
<link rel="stylesheet" href="/css/inventario.css">
<link rel="stylesheet" href="/css/style-mc.css">
@endsection
@section('content')
@auth
<div class="container">
    <h3>Nuevo Ticket</h3>
    <p><span style="color:red">*</span><span class="campoObligatorio">Campo obligatorio</span></p>
    <form method="POST" action="{{route('tickets.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label class="col-form-label">Código <span style="color:red">*</span></label>
            <input type="text" name="codigo" class="form-control">
        </div>
        <div class="form-group">
            <label class="col-form-label">Estado <span style="color:red">*</span></label>
            <select class="custom-select" name="estado">
                <option selected="">Opciones de Estados</option>
                <option value="Pendiente Revision">Pendiente Revisión</option>
                <option value="Cotizacion">Cotización</option>
                <option value="Pendiente Reparacion">Pendiente Reparación</option>
                <option value="Pendiente Pago">Pendiente Pago</option>
                <option value="Finalizado">Finalizado</option>
            </select>
        </div>
        <div class="form-group">
            <label class="col-form-label">Fecha de Inicio <span style="color:red">*</span></label>
            <input type="text" name="fecha_inicio" class="form-control datepicker" placeholder="dd/MM/aaaa">
        </div>
        <div class="form-group">
            <label class="col-form-label">Comentario </label>
            <input type="text" name="comentario" class="form-control" placeholder="Comentario">
        </div>
        <div class="form-group">
            <label class="col-form-label">Serie de Máquina <span style="color:red">*</label>
            <select class="custom-select" name="serie">
                <option selected="">Selecciona</option>
                @foreach ($maquinas as $key => $maquina)
                    <option value="{{$maquina->serie}}">{{$maquina->serie}}</option>
                @endforeach
            </select>
        </div>
        <br>
        <h4>Servicios</h4>
        <label class="col-form-label">Seleccione los servicios que desea agregar: </label>
        <div class="form-group">
            <label class="col-form-label">Arrendamiento <span style="color:red">*</span></label>
            <input type="number" max="9999" class="form-control" name="arrendamiento" placeholder="0.00" min="0" step="0.01" value="0.00">
        </div>
        <div class="form-group">
            <label class="col-form-label">Reparación y Mantenimiento de Fotocopiadora <span style="color:red">*</span></label>
            <input type="number" max="9999" class="form-control" name="reparacionfc" placeholder="0.00" min="0" step="0.01" value="0.00">
        </div>
        <div class="form-group">
            <label class="col-form-label">Reparación y Mantenimiento de Computadora <span style="color:red">*</span></label>
            <input type="number" max="9999" class="form-control" name="reparacionpc" placeholder="0.00" min="0" step="0.01" value="0.00">
        </div>
        <br>
        <h4>Piezas</h4>
        <div class="panel panel-header"></div>
            <div class="panel panel-footer">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Precio Unitario</th>
                            <th>Precio Venta</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                            <th><a href="#" class="addRow"><i class="fas fa-plus-circle"></i></a></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" name="nombre[]" class="form-control nombre" required="" placeholder="Pieza"></td>
                            <td><input type="number" name="precio_unitario[]" class="form-control precio_unitario" required="" min="0.01" step="0.01" placeholder="0.00"></td>
                            <td><input type="number" name="precio_venta[]" class="form-control precio_venta" required="" min="0.01" step="0.01" placeholder="0.00"></td>
                            <td><input type="number" name="cantidad[]" class="form-control cantidad" required="" min="1" placeholder="0"></td>
                            <td><input type="number" name="subtotal[]" class="form-control subtotal" required="" min="0.01" placeholder="0" step="0.01"></td>
                            <td class="remover"><a href="#" class="remove"><i class="fas fa-minus-circle"></i></a></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td style="border: none"></td>
                            <td style="border: none"></td>
                            <td style="border: none"></td>
                            <td>Total</td>
                            <td><b class="total"></b></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

        <button type="submit" class="btn btn-success guardar">Ingresar Ticket</button>
        <a href="/tickets" class="btn btn-danger">Cancelar</a>
    </form><br>
</div>
@section('script')
<script src="{{ asset('js/jquery-1.12.4.js') }}"></script>
<script src="{{ asset('js/jquery-ui.js') }}"></script>
<script>
$(function() {
    $(".datepicker").datepicker({
        dateFormat: '{{ config('app.date_format_js') }}',
    });
});
</script>
<script type="text/javascript">
    $('tbody').delegate('.precio_venta, .cantidad', 'keyup',function(){
        var tr=$(this).parent().parent();
        var precio_venta = tr.find('.precio_venta').val();
        var cantidad = tr.find('.cantidad').val();
        var subtotal = (cantidad*precio_venta);
        tr.find('.subtotal').val(subtotal);
        total();
    });
    function total(){
        var total = 0;
        $('.subtotal').each(function(i,e){
            var subtotal=$(this).val()-0;
            total += subtotal;
        });
    $('.total').html(total);
    }
    $('.addRow').on('click',function(){
        addRow();
    });
    function addRow(){
        var tr='<tr>'+'<td><input type="text" name="nombre[]" class="form-control nombre" required="" placeholder="Pieza"></td>'+
        '<td><input type="number" name="precio_unitario[]" class="form-control precio_unitario" required="" min="0.01" step="0.01" placeholder="0.00"></td>'+
        '<td><input type="number" name="precio_venta[]" class="form-control precio_venta" required="" min="0.01" step="0.01" placeholder="0.00"></td>'+
        '<td><input type="number" name="cantidad[]" class="form-control cantidad" required="" min="1" placeholder="0"></td>'+
        '<td><input type="number" name="subtotal[]" class="form-control subtotal" required="" min="0.01" step="0.01"></td>'+
        '<td class="remover"><a href="#" class="remove"><i class="fas fa-minus-circle"></i></a></td>'
        '</tr>';
        $('tbody').append(tr);
    };
    $('body').on('click','.remove',function(){
        var last=$('tbody tr').length;
        if(last==1){
            alert("No es posible remover la última fila");
        }
        else{
            $(this).parent().parent().remove();
        }
    });
</script>
@endsection
@endauth
@endsection