{{-- Aqui va header y footer--}}
@include('cotizaciones.appCotizaciones')

  <div class="container">
    <div class="thing" id="wrapper">
      @forelse ($promociones as $promocion)
        @if ($promocion->imagen != 'noimage.jpg')
          <div><a href="#"><img src="/images/promociones/{{$promocion->imagen}}"  class="promo" alt="slider image"></a></div>
        @endif
      @empty
        <h1>Actualmente no tenemos promociones disponibles  </h1>
      @endforelse

    </div>
    <br>
    <a class="btn btn-success" href="/home">Bienvenido</a>
  </div>
  <br>
  <div class="contenedor-destacados">
    <br>
    <hr/>
    <h1 class="principal titulo-destacado">DESTACADOS</h1>
    <div class="container">
      <div class="producto destacado ">
        <h3 class="nombre-destacados">PRODUCTOS</h3>
        <a href="{{ route('reserva.categoria.mostrar') }}"> <img src="" class="imagen" id="imagen-producto"></a>
      </div>
      <div class="evento destacado">
        <h3 class="nombre-destacados">EVENTOS</h3>
        <a href="/evento"><img src="" class="imagen" id="imagen-evento"></a>
      </div>
      <div class="sublimacion destacado">
        <h3 class="nombre-destacados">SUBLIMACIONES</h3>
        <a href="{{ route('reserva.categoria.mostrar.unica', 7) }}"><img src="" class="imagen" id="imagen-sublimacion"></a>

      </div>
    </div>

  </div>
  <div class="container">
    <div id="mapa" class="mapa"></div>
    <hr/>
    <div class="cotizacion">
      <h1 class="principal">HAZ TU COTIZACION</h1>
      <br><br>
      <form action="{{ action('CotizacionController@store') }}" method="POST" name="formCotizacion" onsubmit="return validar()" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="lados">
          <div class="izquierda">
            <div class="form-group">
              <input type="text" name="nombre" class="form-control alto" id="nombre" placeholder="Nombre" required>
            </div>

            <div class="form-group">
              <input type="email" name="correo" id="correo" class="form-control alto" placeholder="Correo" required>
            </div>

            <div class="form-group">
              <input type="tel" pattern="[0-9]{8}" name="telefono" id="telefono" class="form-control alto" placeholder="Numero Telefonico" required>
            </div>
          </div>

          <div class="derecha">
            <div class="form-group">
              <textarea type="text" name="descripciontextarea" class="form-control" id="descripciontextarea" placeholder="descripcion" required></textarea>
            </div>
            <div class="form-group ocultar">
              <input type="text" name="descripcion" class="form-control" id="descripcion"  placeholder="Descripcion">
            </div>
          </div>
        </div>


        <div class="centrado">
          <div class="form-group">
            <label>Imagen</label>
            <input type="file" name="imagen"  placeholder="Ingrese la imagen">
          </div>
        </div>
        <input type="submit" onclick="obtenerDescripcion()" class="btn btn-primary btn-cotizacion" value="Enviar">
      </form>
    </div>
  </div>

  {{-- <script src="{{ asset('js/jquery-3.3.1.slim.min.js') }}" > </script> --}}
  <script src="{{ asset('js/jquery11.min.js') }}" > </script>
  <script src="{{ asset('js/highlight.min.js') }}" > </script>
  <script src="{{ asset('js/slick.js') }}" type="text/javascript"></script>
  <script src="{{ asset('js/bootstrap-4.3.1.min.js') }}"> </script>
  <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
  <script src="{{ asset('js/map.js') }}"> </script>
  <script>

  correo = document.getElementById("correo");
  telefono = document.getElementById("telefono");
  telefono1 = document.getElementById("telefono").value;
  telefono.addEventListener('invalid', comprobarNumero);
  telefono.addEventListener('input', comprobarNumero);

  function obtenerDescripcion() {
    var x = "";
    var x = document.getElementById("descripciontextarea").value;
    document.getElementById("descripcion").value = x;
  };

  correo.addEventListener("keyup", function (event) {
    if (correo.validity.typeMismatch) {
      correo.setCustomValidity("¡Yo esperaba una dirección de correo!");
    } else {
      correo.setCustomValidity("");
    }
  });

  window.addEventListener("load", function() {
    formCotizacion.telefono.addEventListener("keypress", soloNumeros, false);
  });

  //Solo permite introducir numeros.
  function soloNumeros(e){
    var key = window.event ? e.which : e.keyCode;
    if (key < 48 || key > 57) {
      e.preventDefault();
    }
  }

  function comprobarNumero(valor, campo){
    var mensaje = "";
    if(this.value == ""){
      mensaje = "El numero no puede estar vacío";
    }else if (this.value.length != 8) {
      mensaje = "Debe ser un numero telefonico de 8 digitos, sin guiones"
    }
    this.setCustomValidity(mensaje);
  };

  function validar() {
    // Obteniendo el valor que se puso en el campo nombre del formulario
    nombre = document.getElementById("nombre").value;
    descripciontextarea = document.getElementById("descripciontextarea").value;

    //La condicion
    if(nombre.length == 0 || /^\s+$/.test(nombre)){
      return false;
    }else if (descripciontextarea.length == 0 || /^\s+$/.test(descripciontextarea)) {
      return false;
    }else {
      return true;
    }
  }
</script>
<script type="text/javascript">
$(document).ready(function(){
  $('.thing').slick({
    dots: true,
    arrows: false,
    autoplay:true,
    autoplaySpeed:3000,
    slidesToShow:1,
    slidesToScroll:1

  });
});
</script>
<script>
/**
* Array con las imagenes y enlaces que se iran mostrando en la web
*/
var imagenes= [];
var imagenesEventos=new Array(
  ['images/eventos/1.jpg'],
  ['images/eventos/2.jpg'],
  ['images/eventos/3.jpg'],
  ['images/eventos/4.jpg']
);
var imagenesSublimaciones=new Array(
  ['images/sublimaciones/1.jpg'],
  ['images/sublimaciones/2.jpg'],
  ['images/sublimaciones/3.jpg'],
  ['images/sublimaciones/4.jpg']
);
@foreach ($productos as $producto)

@if ($producto->imagen != "noimage.jpg")
imagenes.push('/images/{{$producto->imagen}}')
@endif
@endforeach
console.log(imagenes);
var contador = 0;
var contador1 = 0;
var contador2 = 0;
/*** Funcion para cambiar la imagen y link*/
function rotarImagenes()
{
  // cambiamos la imagen y la url

  document.getElementById("imagen-producto").src=imagenes[contador];
  document.getElementById("imagen-evento").src=imagenesEventos[contador1];
  document.getElementById("imagen-sublimacion").src=imagenesSublimaciones[contador2];
  contador++;
  contador1++;
  contador2++;
  if (contador == imagenes.length) {
    contador = 0;
  }
  if (contador1 == imagenesEventos.length) {
    contador1 = 0;
  }
  if (contador2 == imagenesSublimaciones.length) {
    contador2 = 0;
  }

}
/*** Función que se ejecuta una vez cargada la página*/
onload=function()
{
  // Cargamos una imagen aleatoria
  rotarImagenes();
  // Indicamos que cada 5 segundos cambie la imagen
  setInterval(rotarImagenes,5000);
}
</script>


{{-- @auth --}}
