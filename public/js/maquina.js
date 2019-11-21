$(document).ready( function () {
    var table =  $('#datatable').DataTable({
                    language: {
                      "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
                    }
        });

//Star Edit Record
table.on('click','.edit', function () {

    $tr = $(this).closest('tr');
    if ($($tr).hasClass('child')){
       $tr = $tr.prev('.parent');
    }

    var data = table.row($tr).data();
    
    
    $('#contacto_id').val(data[1]);
    $('#categoria_id').val(data[2]);
    $('#marca').val(data[3]);
    $('#modelo').val(data[4]);
    $('#contador').val(data[5]);
    $('#serie').val(data[6]);
    $('#descripcion').val(data[7]);

    $('#editForm').attr('action', '/maquina/'+data[0]); 
    $('#editModal').modal('show');
  });
});