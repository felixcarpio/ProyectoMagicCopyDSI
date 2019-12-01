<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Magic Copy</title>
  <link rel="stylesheet" href="/css/fontawesome-all.min.css">
  <link rel="stylesheet" href="/css/publicidad.css">
  <link href="{{ asset('css/bootstrap-4.3.1.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="/css/slick.css">
  <link rel="stylesheet" href="/css/sweetalert2.min.css">
  <link rel="stylesheet" href="/css/slick-theme.css">

</head>
<body>

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
    <ul class="navbar-nav nav-fill w-100">
      <li class="nav-item dropdown">
        <img src="/images/cart.jpeg" class="nav-link dropdown-toggle img-fluid" height="70px"
        width="70px" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">
        <div id="carrito" class="dropdown-menu" aria-labelledby="navbarCollapse">
          <table id="lista-carrito" class="table">
            <thead>
              <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th></th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>

          <a href="#" id="vaciar-carrito" class="btn btn-primary btn-block">Vaciar Carrito</a>
          <a href="#" id="procesar-pedido" class="btn btn-danger btn-block">Procesar
            Reserva</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('reserva.categoria.mostrar.unica', 1) }}">Papeleria</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('reserva.categoria.mostrar.unica', 2) }}">Articulos de Fiesta</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('reserva.categoria.mostrar.unica', 3) }}">Utiles Escolares</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('reserva.categoria.mostrar.unica', 4) }}">Fotocopias</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('reserva.categoria.mostrar.unica', 5) }}">Ploteos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('reserva.categoria.mostrar.unica', 6) }}">Varios</a>
        </li>

      </ul>
    </div>
  </nav>





  {{-- <nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <!-- Brand -->
  <a class="navbar-brand" href="#">MagicCopy</a>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
  <span class="navbar-toggler-icon"></span>
</button>
<!-- Navbar links -->
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
<li class="nav-item dropdown">
<img src="/images/cart.jpeg" class="nav-link dropdown-toggle img-fluid" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true"
aria-expanded="false"></img>
<div id="carrito" class="dropdown-menu" aria-labelledby="navbarCollapse">
<table id="lista-carrito" class="table">
<thead>
<tr>
<th>Imagen</th>
<th>Nombre</th>
<th>Precio</th>
<th></th>
</tr>
</thead>
<tbody></tbody>
</table>

<a href="#" id="vaciar-carrito" class="btn btn-primary btn-block">Vaciar Carrito</a>
<a href="#" id="procesar-pedido" class="btn btn-danger btn-block">Procesar Compra</a>
</div>
</li>
</ul>
</div>
</nav> --}}

@yield('content')

<script src="{{ asset('js/jquery-3.3.1.slim.min.js') }}" > </script>
<script src="{{ asset('js/popper.min.js') }}"> </script>
<script src="{{ asset('js/bootstrap-4.3.1.min.js') }}"></script>
<script src="{{ asset('js/sweetalert2.min.js') }}"></script>

</body>
</html>
