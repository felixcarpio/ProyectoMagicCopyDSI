$(document).ready(function () {
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
      table.on('click', '.edit', function(){
        $tr = $(this).closest('tr');
        if ($($tr).hasClass('child')){
           $tr = $tr.prev('.parent');
        }

        var data = table.row($tr).data();
        console.log(data);

        $('#codigo').val(data[1]);
        $('#estado').val(data[2]);
        $('#fecha_inicio').val(data[3]);
        $('#fecha_fin').val(data[4]);
        $('#total').val(data[5]);
        $('#comentario').val(data[6]);
        $('#maquina_id').val(data[7]);
        $('#editarTicketForm').attr('action', '/tickets/'+data[0]);
        $('#editarTicketModal').modal('show');
      });
    });