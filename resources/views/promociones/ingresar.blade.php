@extends('layouts.app')
@section('nombre')
Ingresar Promoción
@endsection
@section('links')
<script src="{{ asset('js/jquery-3.3.1.min.js')}}"></script>
<script src="{{ asset('js/jquery.min.js')}}"></script>

<link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">

@endsection
@section('content')
@auth
<div class="container">
    <h5>Ingresar Promoción</h5> 
    <br>
    <p><span style="color:red">*</span> <span class="campoObligatorio">Campo obligatorio</span></p>
    <form method="POST" action="{{ action('PromocionController@store')}}" name="formulario" enctype="multipart/form-data">
        <!-- {{ csrf_field() }} -->
        @method('PUT')
        @csrf
        <div class="form-group">
            <label class="col-form-label">Nombre de la Promoción <span style="color:red">*</span> </label>
            <input type="text" name="nombre" class="form-control">
        </div>

        <div class="form-group">
            <label class="col-form-label">Fecha de inicio <span style="color:red">*</span> </label>
            <input type="text" name="fecha_inicio" class="form-control datepicker" placeholder="dd/MM/aaaa">
        </div>

        <div class="form-group">
            <label class="col-form-label">Fecha de finalización <span style="color:red">*</span> </label>
            <input type="text" name="fecha_fin" class="form-control datepicker" placeholder="dd/MM/aaaa">
        </div>
        <br>
        <div class="form-group">
            <label>Imagen</label>
            <input type="file" name="imagen" id="imagen"  placeholder="Ingrese el nombre de la imagen">
          </div>

        <br>

        <div class="form-group">
            <label class="col-form-label"> Seleccione los productos que incluirá la promoción <span style="color:red">*</span> </label>
        </div>

        <div class="panel panel-footer">
        <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio unitario por producto en la promoción</th>
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
                        <td><input type="number" name="cantidad[]" required="" class="form-control cantidad" min="1" step="1" oninput="precioPromocion()"></td>
                        <td><input type="number" name="precio_unitario[]" required="" class="form-control precio" min="0.00" step="0.01" id="precio" oninput="precioPromocion()"></td>
                        <td class="remover"><a href="#" class="remove"><i class="fas fa-minus-circle"></i></a></td>
                    </tr>
                    </tr>
                </tbody>
            </table>

            <div class="form-group">
                <label class="col-form-label">Precio con la promoción:
                </label>
                <label id="precioPromocion"> </label>
            </div>
            <div>
                <input class="ocultar" type="text" name="precio_con_descuento" id="precioPromo">
            </div>
        </div>

        <button type="submit" class="btn btn-success guardar">Guardar</button>
        <a href="/promocion" class="btn btn-danger">Cancelar</a>
    </form>
</div>

<script type="text/javascript">
    function precioPromocion() {
        const inputPrecio = document.getElementsByClassName('precio');
        const inputCantidad = document.getElementsByClassName('cantidad');
        let precio = 0,
            cantidad = 0,
            total = 0;
        for (let i = 0; i < inputPrecio.length; i++) {
            precio = parseFloat(inputPrecio[i].value);
            cantidad = parseFloat(inputCantidad[i].value);
            if (!isNaN(precio) && !isNaN(cantidad)) {
                // console.log(precio);
                // console.log(cantidad);
                total += precio * cantidad;
                // console.log(total);
                let labelPrecio = document.getElementById('precioPromocion').textContent = total.toFixed(2);
            }
        }
    }

    $('.guardar').on('click', () => {
        let labelPrecio = document.getElementById('precioPromocion').textContent;
        let inputPrecio = document.getElementById('precioPromo').value = labelPrecio;
    });

    $('tbody').delegate('.quantity,', 'keyup', function() {
        var tr = $(this).parent().parent();
        var quantity = tr.find('.quantity').val();
    });

    function total() {
        var total = 0;
        $('.amount').each(function(i, e) {
            var amount = $(this).val() - 0;
            total += amount;
        });
        $('.total').html(total + ".00 tk");
    }
    $('.addRow').on('click', function() {
        addRow();
    });

    function addRow() {
        var tr = '<tr>' +
            '<td>' +
            '<select name="producto[]" class="form-control" required=""> ' +
            '@if($productos)' +
            '@foreach ($productos as $producto)' +
            '<option value="{{ $producto->id }}"> {{ $producto->nombre }} </option>' +
            '@endforeach' +
            '@else' +
            '<option>No existen Productos</option>' +
            '@endif' +
            '</select>' +
            '<td><input type="number" name="cantidad[]" required="" class="form-control cantidad" min="1" oninput="precioPromocion()"></td>' +
            '<td><input type="number" name="precio_unitario[]" required="" class="form-control precio" min="0.00"  step="0.01" oninput="precioPromocion()"></td>' +
            '<td class="remover"><a href="#" class="remove"><i class="fas fa-minus-circle"></i></a></td>' +
            '</tr>';
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
    window.addEventListener("load", function() {
      formulario.fecha_inicio.addEventListener("keypress", soloFecha, false);
      formulario.fecha_fin.addEventListener("keypress", soloFecha, false);
    });

    function soloFecha(e){
      var key = window.event ? e.which : e.keyCode;
      if (key > 7 || key < 190) {
        e.preventDefault();
      }
    }
</script>


@section('script')

<script src="{{ asset('js/jquery-1.12.4.js') }}"></script>
<script src="{{ asset('js/jquery-ui.js') }}"></script>
<script src="{{ asset('js/conf-datepicker.js') }}"></script>
<script>
    $(function() {
        $(".datepicker").datepicker({
            dateFormat: '{{ config('app.date_format_js') }}',
        }); 
    });
</script>
@endsection
@endsection
@endauth