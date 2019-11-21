$(document).ready( () => {
  $(function() {
    $(".datepicker").datepicker({
      dateFormat: 'dd/mm/yy',
    })
  })

  window.addEventListener("load", function() {
      formulario.fecha_emision.addEventListener("keypress", soloFecha, false)
    })
    function soloFecha(e){
      var key = window.event ? e.which : e.keyCode;
      if (key > 7 || key < 190) {
        e.preventDefault();
      }
    }

    $(function(){
      $('#tipo').on('change', function () {
          var id = $(this).val()
          if (id == 1) { 
              window.location = "/salida/venta"
          }
          return false
      })
    })
})