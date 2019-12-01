{{-- Aqui va header y footer--}}
@include('cotizaciones.appCotizaciones')

<div class="container" id="lista-productos">

    <div class="catalogoProductos" >
      <div class="cotizacion" >
        @forelse ($productos as $producto)
          <div class="card mb-4 shadow-sm productoStore" id="producto">
            {{-- <label class="id" style="display: none">{{$producto->id}}</label> --}}
            <div class="headerProducto">
              <div class="imagenProducto">
                <img class="imagenPublicidad" src="/images/{{$producto->imagen}}">
              </div>
            <div class="descripcionProducto">
              <div class="card-header nombreProducto">
                <h2 class="my-0 font-weight-bold">{{$producto->nombre}}</h2>
              </div>
              <div class="descripcion">
                <p>{{$producto->descripcion}}</p>
              </div>
              <div class="existencias">
                <label class="existencias">Existencias :{{$producto->existencias}}</label>
              </div>
            </div>
            </div>
            <hr>
            <div class="footerProducto">
              <div class="footerDerecha">
                @if ($producto->precio_con_descuento != NULL)
                  <img src="/images/OfertaEspecial.png" class="imagenOferta">
                @endif
              </div>
              <div class="footerIzquierda">
                <div class="input">
                    <input type="number" name="cantidad" min="1" class="cantidad" value="0">
                    @if ($producto->precio_con_descuento != NULL)
                      <label class="precioDescuento">{{$producto->precio_con_descuento}}</label>
                      <br>
                      <label class="precio eliminado">{{$producto->precio}}</label>
                    @else
                        <label class="precio">{{$producto->precio}}</label>
                    @endif
                </div>

              </div>
              <a href="" class="btn btn-block btn-primary agregar-carrito" data-id="{{$producto->id}}">Reservar</a>
            </div>

          </div>
        @empty
          <p>no hay productos</p>
        @endforelse
      </div>

    </div>
</div>

<script type="text/javascript" src="/js/carrito.js"></script>
<script type="text/javascript" src="/js/pedido.js"></script>
