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
          console.log(data);
  
          $('#nombre').val(data[1]);         
          $('#nit').val(data[2]);          
          $('#registro').val(data[3]);
          $('#giro').val(data[4]); 
          $('#direccion').val(data[5]);
          $('#correo').val(data[6]);
  
          $('#editForm').attr('action', '/empresa/'+data[0]);
          $('#editModal').modal('show');
        });
         
    });