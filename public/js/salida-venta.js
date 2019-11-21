$(document).ready(() => {
  $(function () {
    $(".datepicker").datepicker({
      dateFormat: 'dd/mm/yy',
    })
  })

  window.addEventListener("load", function () {
    formulario.fecha_emision.addEventListener("keydown", soloFecha, false)
  })
  function soloFecha(e) {
      e.preventDefault();
  }

  $(function () {
    $('#tipo').on('change', function () {
      var id = $(this).val()
      if (id != 1) {
        window.location = "/salida"
      }
      return false
    })
  })
  
  window.addEventListener("load", function() {
    formularioIngresarEntidad.nit.addEventListener("keypress", soloNumeros, false);
    formularioIngresarEntidad.numero_registro.addEventListener("keypress", soloNumeros, false);
    formulario.cantidad_promociones.addEventListener("keypress", soloNumeros, false);
  });
  //Solo permite introducir numeros.
  function soloNumeros(e){
    var key = window.event ? e.which : e.keyCode;
    if (key < 48 || key > 57) {
      e.preventDefault();
    }
  }
})