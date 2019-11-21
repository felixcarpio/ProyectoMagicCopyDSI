    <div class="container sidebar">
        {{-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button> --}}
            @auth
              <ul>
                <li> <a href="#">Inicio</a> </li>
                <li> <a href="#">Inventario</a> </li>
                <ul>
                  <li> <a href="#">Ingresar Pedido</a> </li>
                  <li> <a href="#">Recepción de Pedido</a> </li>
                </ul>
                <li> <a href="#">Productos</a> </li>
                <ul>
                  <li> <a href="#">Marcas</a> </li>
                  <li> <a href="#">Proveedores</a> </li>
                </ul>
                <li> <a href="#">Usuarios</a> </li>
                <ul>
                  <li> <a href="#">Roles</a> </li>
                </ul>
              </ul>
            @endauth
    </div>
