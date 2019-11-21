@extends('layouts.appticket')
@section('nombre')
Actualizar Contacto
@endsection
@section('links')
<script src="{{ asset('js/jquery-3.3.1.min.js')}}"></script>
<script src="{{ asset('js/jquery.min.js')}}"></script>

<link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">

@endsection
@section('content')
<div class="container">
    <h5>Actualizar Contacto</h5>
    <br>
    <p><span style="color:red">*</span> <span class="campoObligatorio">Campo obligatorio</span></p>
    <form method="POST" action=" {{ route('contacto.update', $contacto->id) }}" name="formulario" enctype="multipart/form-data">
        @method('PUT')
        @csrf

            <div class="form-group">
              <label>Nombre<span style="color:red">*</span> </label>
              <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ingrese el nombre del Contacto">
            </div>

            <div class="form-group">
              <label>Apellido<span style="color:red">*</span></label>
              <input type="text" name="apellido" id="apellido" class="form-control" placeholder="Ingrese el apellido del Contacto">
            </div>

            <div class="form-group">
              <label>Correo<span style="color:red">*</span> </label>
              <input type="email" name="correo" id="correo" class="form-control" placeholder="Ingrese el correo del Contacto">
            </div>

            <div class="form-group">
              <label>DUI<span style="color:red">*</span> </label>
              <input type="text" name="dui" id="dui" class="form-control" placeholder="99999999-9">
            </div>

            <div class="form-group">
              <label>Direccion<span style="color:red">*</span> </label>
              <input type="text" name="direccion" id="direccion" class="form-control" placeholder="Ingrese la direccion del Contacto">
            </div>

 <!-- Inicio tabla telefono -->
        <div class="form-group">
            <label class="col-form-label"> Telefono <span style="color:red">*</span> </label>
        </div>

        <div class="panel panel-footer">
        <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Numero</th>
                        <th><a href="#" class="addRow"><i class="fas fa-plus-circle"></i></a></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td><input type="string" max="99999999" required="" class="form-control" min="1" placeholder="99999999"></td>                       
                       </tr>
                    </tr>
                </tbody>
            </table>

        </div>

          <div class="form-group">
            <label>Empresa<span style="color:red">*</span> </label>

            <select class="form-control">
                  <option value="{{ $empresas[0]->empresa_id }}">{{ $empresas[0]->nombre }}</option>
            </select>
           </div>

          <button type="submit" class="btn btn-success guardar">Actualizar</button>
        <a href="/contacto" class="btn btn-danger">Cancelar</a>
    </form>
</div>


<script type="text/javascript">
    
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
        var tr = '<tr>'  +
            '<td><input type="string" name="numero[]" required="" class="form-control" min="1" placeholder="99999999"></td>' +
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
</script>


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
@endsection
@endsection