<nav class="nav_difuminado navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/crearcotizacion') }}">
            Magic Copy
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>
            @auth
              <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                  <a class="nav-link" href="{{route('producto.index')}}"> <span style="color:black"> Productos<span class="sr-only">(current)</span> </span> </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{route('inventario')}}"> <span style="color:black"> Inventario </span> </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/promocion"> <span style="color:black"> Promociones </span> </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{route('users.index')}}"> <span style="color:black"> Usuarios </span> </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/cotizaciones"> <span style="color:black"> Cotizaciones </span> </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/reservas"> <span style="color:black"> Reservas </span> </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/imagenes_evento"> <span style="color:black"> Eventos </span> </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/reporteventas"> <span style="color:black"> Reportes </span> </a>
                </li>
                
              </ul>
            @endauth

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}"> <span style="color:black"> {{ __('Iniciar Sesión') }} </span> </a>
                    </li> 
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <span style="color:black">  {{ Auth::user()->username }} <span class="caret"></span> </span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Cerrar Sesión') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
