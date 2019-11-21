$(document).ready(function () {
    // Script datatable
    var table = $('#datatable').DataTable({
        language: {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    });

    // Script Actualizar
    table.on('click', '.edit', function(){
        $tr = $(this).closest('tr');
        if($($tr).hasClass('child')){
            $tr = $tr.prev('.parent');
        }

        var data = table.row($tr).data();

        console.log(data);
        
        
        $('#nombre').val(data[1]);
        $('#nit-actualizar').val(data[2]);
        $('#registro-actualizar').val(data[3]);
        $('#direccion').val(data[4]);
        $('#giro').val(data[5]);

        $('#editForm').attr('action', '/entidad/'+data[0]);
        $('#editModal').modal('show');
    });

    // Script Borrar
    table.on('click', '.delete', function () {
        $tr = $(this).closest('tr');
        if ($($tr).hasClass('child')) {
            $tr = $tr.prev('.parent');
        }

        var data = table.row($tr).data();

        $('#deleteForm').attr('action', '/entidad/' + data[0]);
        $('#deleteModal').modal('show');
    });

    window.addEventListener("load", function() {
      formularioIngresarEntidad.nit.addEventListener("keypress", soloNumeros, false);
      formularioIngresarEntidad.numero_registro.addEventListener("keypress", soloNumeros, false);
      formularioActualizarEntidad.nit.addEventListener("keypress", soloNumeros, false);
      formularioActualizarEntidad.numero_registro.addEventListener("keypress", soloNumeros, false);
    });
    //Solo permite introducir numeros.
    function soloNumeros(e){
      var key = window.event ? e.which : e.keyCode;
      if (key < 48 || key > 57) {
        e.preventDefault();
      }
    }
});