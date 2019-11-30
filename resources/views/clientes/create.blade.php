@extends('layouts.appticket')
@section('nombre')
Ingresar Cliente
@endsection
@section('links')
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}}
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"> --}}
<link rel="stylesheet" href="/css/inventario.css">
<link rel="stylesheet" href="/css/style-mc.css">
@endsection
@section('content')
@auth
    <div class="container">
        <h3>Nuevo Cliente</h3>
        <p><span style="color:red">*</span><span class="campoObligatorio">Campo Obligatorio</span></p>
        <form method="POST" action="{{route('clientes.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="col-form-label">Nombre de Cliente: <span style="color:red">*</span></label>
                <input type="text" name="nombre" class="form-control">
                <label class="col-form-label">Apellido de Cliente: <span style="color:red">*</span></label>
                <input type="text" name="apellido" class="form-control">
                <label class="col-form-label">Correo de Cliente: <span style="color:red">*</span></label>
                <input type="text" name="correo" class="form-control">
                <label class="col-form-label">DUI de Cliente: </label>
                <input type="text" name="dui" class="form-control">
                <label class="col-form-label">Nombre de Empresa: </label>
                <input type="text" name="nombre_empresa" class="form-control">
                <label class="col-form-label">Dirección de Cliente: <span style="color:red">*</span></label>
                <input type="text" name="direccion" class="form-control">

                <!-- Inicio tabla telefono -->
                <div class="form-group">
                    <label class="col-form-label">Telefono: <span style="color:red">*</span></label>
                </div>

                <div class="panel panel-footer">
                    <table class="table table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>Número</th>
                                <th><a href="#" class="addRow"><i class="fas fa-plus-circle"></i></a></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="number" max="99999999" step="1" name="numero[]" required="" class="form-control" placeholder="99999999"></td>
                                <td class="remover"><a href="#" class="remove"><i class="fas fa-minus-circle"></i></a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <button type="submit" class="btn btn-success guardar">Guardar</button>
                <a href="/clientes" class="btn btn-danger">Cancelar</a>
            </div>
        </form>
    </div>
@section('script')
<script type="text/javascript">
$('tbody').delegate('.quantity','keyup',function(){
    var tr = $(this).parent().parent();
    var quantity = tr.find('.quantity').val();
});

function total(){
    var total=0;
    $('.amount').each(function(i,e){
        var amount=$(this).val() - 0;
        total += amount;
    });
    $('.total').html(total + ".00 tk");
}
$('.addRow').on('click',function(){
    addRow();
});

function addRow(){
    var tr = '<tr>'+
    '<td><input type="number" max="99999999" step="1" name="numero[]" required="" class="form-control" placeholder="99999999"></td>'+
    '<td class="remover"><a href="#" class="remove"><i class="fas fa-minus-circle"></i></a></td>'+
    '</tr>';
    $('tbody').append(tr);
};

$('body').on('click','.remove',function(){
    var last = $('tbody tr').length;
    if(last == 1){
        alert("No es posible remover la última fila");
    }else{
        $(this).parent().parent().remove();
    }
});
</script>
@endsection
@endauth
@endsection