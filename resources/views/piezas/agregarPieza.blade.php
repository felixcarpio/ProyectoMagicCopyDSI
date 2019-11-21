@extends('layouts.appticket')
@section('nombre')
  Agregar Piezas
@endsection
@section('links')
<meta charset="utf-8">
<title>MagicCopy</title>
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}}
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"> --}}
<link rel="stylesheet" href="/css/inventario.css">
<link rel="stylesheet" href="/css/style-mc.css">
@endsection
@section('content')
<div class="container">
    <h3>Agregar Piezas</h3><br>
    <form action="">
        @method('PUT')
        @csrf
        <section>
            <div class="panel panel-header"></div>
            <div class="panel panel-footer">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Precio Unitario</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                            <th><a href="#" class="addRow"><i class="fas fa-plus-circle"></i></a></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" name="nombre[]" class="form-control nombre" required="" placeholder="Pieza"></td>
                            <td><input type="text" name="descripcion[]" class="form-control descripcion" required="" placeholder="Descripción"></td>
                            <td><input type="number" name="precio_unitario[]" class="form-control precio_unitario" required="" min="0.01" step="0.01" placeholder="0.00"></td>
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
        </section>
        <br>
        <button type="submit" class="btn btn-success guardar">Agregar Piezas</button>
        <a href="#" class="btn btn-danger">Cancelar</a>
    </form><br>
</div>
@section('script')
</script>
<script type="text/javascript">
    $('tbody').delegate('.precio_unitario, .cantidad', 'keyup',function(){
        var tr=$(this).parent().parent();
        var precio_unitario = tr.find('.precio_unitario').val();
        var cantidad = tr.find('.cantidad').val();
        var subtotal = (cantidad*precio_unitario);
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
        var tr='<tr>'+'<td><input type="text" name="nombre[]" class="form-control nombre" required=""></td>'+
        '<td><input type="text" name="descripcion[]" class="form-control descripcion" required=""></td>'+
        '<td><input type="number" name="precio_unitario[]" class="form-control precio_unitario" required="" min="0.01"></td>'+
        '<td><input type="number" name="cantidad[]" class="form-control cantidad" required="" min="0.01"></td>'+
        '<td><input type="number" name="subtotal[]" class="form-control subtotal" required="" min="0.01"></td>'+
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
@endsection