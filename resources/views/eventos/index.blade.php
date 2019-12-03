<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Magic Copy</title>

  <link href="{{ asset('css/bootstrap-4.3.1.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="/css/publicidad.css">

  <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">
</head>
<header class="site-header">

    <div class="hero">
      <div class="contenido-header">
        <nav class="redes-sociales">
          <a href="https://www.facebook.com/magiccopy16/"><i class="fab fa-facebook-f"></i></a>
          <a href="https://www.facebook.com/magiccopy16/"><i class="fab fa-twitter"></i></a>
          <a href="https://www.facebook.com/magiccopy16/"><i class="fab fa-instagram"></i></a>
        </nav>

      </div>


    </div><!--.hero-->
  </header>




  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a class="navbar-brand" href="/crearcotizacion">MagicCopy</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarCollapse">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="#">Papeleria</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Cuadernos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Utiles Escolares</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Manualidades</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Lapices y Lapiceros</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Articulos de Oficina</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Varios</a>
        </li>

      </ul>
    </div>
  </nav>

<body>
  <div class="container">
  
    
      <div class="row mt-4 eventos">
          @foreach ($imagenesevento as $imagenevento)
        <div class="col-md-4 col-sm-6 col-xs-12 evento">
        <div><h2>{{$imagenevento->nombre}}</h2></div>
          <div >
              <img style="width:250px;height:250px" class="imagenPublicidad" src="/images/imageneseventos/{{$imagenevento->imagen}}">
          </div>
      </div>
      
  @endforeach
  </div>

    <br>
    <hr/>
    <div class="cotizacion">
      <h1 class="principal">HAZ TU COTIZACION</h1>
      <br><br>
      <form action="{{ action('EventoController@store') }}" method="POST" name="formCotizacionEvento" onsubmit="return validar()" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="lados">
          <div class="izquierda">
            <div class="form-group">
                <label class="">Fecha de Evento</label>
                <input name="fechaEvento" class="form-control datepicker alto" id="fechaEvento" placeholder="dd/MM/aaaa" required>
            </div>

            <div class="form-group">
              <label class="">Cantidad de Personas</label>
              <input type="number" name="cantidadPersonas" class="form-control alto" id="cantidadPersonas" min="1" step="1" placeholder="Cantidad de Personas" required>
            </div>

            <div class="form-group">
                <label class="">Tema</label>
                <input type="text" name="tema" class="form-control alto" id="tema" placeholder="Tema del Evento">
            </div>

            <div class="form-group">
              <label class="">Cuentanos más de lo que deseas para tu evento</label>
              <textarea type="text" name="descripciontextarea" class="form-control" id="descripciontextarea" placeholder="descripcion" required></textarea>
            </div>
            <div class="form-group ocultar">
              <input type="text" name="descripcion" class="form-control" id="descripcion"  placeholder="Descripcion">
            </div>

            <div class="form-group">
              <label>Tipo de Lugar</label>
              <select name="clasificacion_id" class="form-control" required>
                @foreach ($clasificaciones as $clasificacion)
                    <option value="{{ $clasificacion->id }}">{{ $clasificacion->nombre }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
                <label class="">Nombre del Lugar</label>
                <input type="text" name="lugar" class="form-control alto" id="lugar" placeholder="Nombre del lugar" required>
            </div>

          </div>

          <div class="derecha">
            <h5>Más para tu evento</h5>
            <label>Tarjetas de Invitacion?</label>
            <div>
              <input type="radio" id="tarjetaSi"
               name="tarjeta" value="1" checked>
              <label for="tarjetaSi">Si</label>

              <input type="radio" id="tarjetaNo"
               name="tarjeta" value="0">
              <label for="tarjetaNo">No</label>
            </div>
            <br>
            <label>Mesas con boquitas?</label>
            <div>
              <input type="radio" id="boquitaSi"
               name="boquita" value="1" checked>
              <label for="boquitaSi">Si</label>

              <input type="radio" id="boquitaNo"
               name="boquita" value="0">
              <label for="boquitaNo">No</label>
            </div>
            <br>
            <label>Centros de Mesa?</label>
            <div>
              <input type="radio" id="centroMesaSi"
               name="centroMesa" value="1" checked>
              <label for="boquitaSi">Si</label>

              <input type="radio" id="centroMesaNo"
               name="centroMesa" value="0">
              <label for="centroMesaNo">No</label>
            </div>
            <br>
            <label>Arco de Entrada?</label>
            <div>
              <input type="radio" id="arcoSi"
               name="arco" value="1" checked>
              <label for="arcoSi">Si</label>

              <input type="radio" id="arcoNo"
               name="arco" value="0">
              <label for="arcoNo">No</label>
            </div>
            <br>
            <label>Recuerdos?</label>
            <div>
              <input type="radio" id="recuerdoSi"
               name="recuerdo" value="1" checked>
              <label for="recuerdoSi">Si</label>

              <input type="radio" id="recuerdoNo"
               name="recuerdo" value="0">
              <label for="recuerdoNo">No</label>
            </div>
            <br>
            <label>Comida?</label>
            <div>
              <input type="radio" id="comidaSi"
               name="comida" value="1" checked>
              <label for="comidaSi">Si</label>

              <input type="radio" id="comidaNo"
               name="comida" value="0">
              <label for="comidaNo">No</label>
            </div>

          </div>
        </div>


        <div class="centrado">
          <div class="form-group">
            <label>Imagen</label>
            <input type="file" name="imagen"  placeholder="Ingrese la imagen">
          </div>
        </div>

        <div class="izquierda">
          <div class="form-group">
            <input type="text" name="nombre" class="form-control alto" id="nombre" placeholder="Nombre" required>
          </div>
        </div>

        <div class="derecha">
          <div class="form-group">
            <input type="email" name="correo" id="correo" class="form-control alto" placeholder="Correo" required>
          </div>
        </div>

        <div class="centrado">
          <div class="form-group">
            <input type="tel" pattern="[0-9]{8}" name="telefono" id="telefono" class="form-control alto center" placeholder="Numero Telefonico" required>
          </div>
        </div>


        <input type="submit" onclick="obtenerDescripcion()" class="btn btn-primary btn-cotizacion" value="Enviar">
      </form>
    </div>
  </div>
  <script src="{{ asset('js/bootstrap-4.3.1.min.js') }}"> </script>
  <script src="{{ asset('js/jquery-1.12.4.js') }}"></script>
  
  
  <script src="{{ asset('js/jquery-ui.js') }}"></script>
  {{-- <script src="{{ asset('js/jquery-3.3.1.min.js')}}"></script> --}}
  <script src="{{ asset('js/conf-datepicker.js')}}"></script>
 
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
    formCotizacionEvento.telefono.addEventListener("keypress", soloNumeros, false);
    formCotizacionEvento.fechaEvento.addEventListener("keypress", soloFecha, false);
  });

  //Solo permite introducir numeros.
  function soloNumeros(e){
    var key = window.event ? e.which : e.keyCode;
    if (key < 48 || key > 57) {
      e.preventDefault();
    }
  }
  function soloFecha(e){
    var key = window.event ? e.which : e.keyCode;
    if (key > 9 || key < 190) {
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
</body>
</html>
{{-- @auth --}}
