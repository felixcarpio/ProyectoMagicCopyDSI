<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />

  <title>@yield('nombre')</title>

  <!-- Scripts -->
  {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
  <!-- Fonts -->
  <link rel="dns-prefetch" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">


  <!-- Styles -->
  <link href="{{ asset('css/bootstrap-4.3.1.min.css') }}" rel="stylesheet">
  <link href="/css/style-mc.css" rel="stylesheet" >
  <link rel="stylesheet" href="/css/datatable-bootstrap4.min.css">

  <link rel="stylesheet" href="/css/style-mc.css">
  <link rel="stylesheet" href="/css/fontawesome-all.min.css">
  <link rel="stylesheet" href="/css/nav_difuminado.css">
  <link rel="shortcut icon" href="/css/iconoMC">

  @yield('links')
</head>
<body>
  @include('inc.navbar')
  <div id="app">
    <main class="py-4">
      <div class="container contenedor">
        @include('inc.messages')
        @yield('content')
      </div>
    </main>
  </div>

  <script src="{{ asset('js/jquery-3.3.1.slim.min.js') }}" > </script>
  <script src="{{ asset('js/popper.min.js') }}"> </script>
  <script src="{{ asset('js/bootstrap-4.3.1.min.js') }}"> </script>
  <script src="{{ asset('js/datatables-jquery.min.js') }}"> </script>
  <script src="{{ asset('js/datatables-boostrap4.min.js') }}"> </script>

    @yield('script')
  </body>
</html>
