$(document).ready(function () {

    //  var table = $('#datatable').DataTable();
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

        $('#username').val(data[1]);
        $('#nombre').val(data[2]);
        $('#apellido').val(data[3]);
        $('#email').val(data[4]);
        $('#direccion_usuario').val(data[5]);
        $('#telefono_usuario').val(data[6]);
        $('#roles_id').val(data[7]);
        $('#editarUserForm').attr('action', '/users/'+data[0]);
        $('#editarUserModal').modal('show');
      });

      // Start Delete Record
        table.on('click', '.delete', function() {

          $tr = $(this).closest('tr');
          if($($tr).hasClass('child')) {
            $tr = $tr.prev('.parent');
          }

          var data = table.row($tr).data();
          console.log(data);

          //$('#id').val(data[0]);

          $('#deleteUserForm').attr('action', '/users/'+data[0]);
          $('#deleteUserModal').modal('show');
        });
    });
