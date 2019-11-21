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
      // table.on('click','.edit', function () {
      //
      //   $tr = $(this).closest('tr');
      //   if ($($tr).hasClass('child')){
      //      $tr = $tr.prev('.parent');
      //   }
      //
      //   var data = table.row($tr).data();
      //   console.log(data);
      //
      //   $('#nombre').val(data[1]);
      //   $('#codigo').val(data[2]);
      //   $('#descripcion').val(data[3]);
      //   $('#precio').val(data[4]);
      //   $('#existencias').val(data[5]);
      //   $('#marcas_id').val(data[6]);
      //   $('#proveedor_id').val(data[7]);
      //
      //   $('#editForm').attr('action', '/producto/'+data[0]);
      //   $('#editModal').modal('show');
      // });

      //Star view
      // table.on('click','.view', function () {
      //
      //   $('#viewModal').modal('show');
      // });

      // Start Delete Record
        table.on('click', '.delete', function() {

          $tr = $(this).closest('tr');
          if($($tr).hasClass('child')) {
            $tr = $tr.prev('.parent');
          }

          var data = table.row($tr).data();
          console.log(data);

          //$('#id').val(data[0]);

          $('#deleteForm').attr('action', '/cotizaciones/'+data[1]);
          $('#deleteModal').modal('show');
        });
        //End Delete Record

    });
