{{-- Aqui va header y footer--}}
@include('reservas.appReserva')
<div class="container">
  <div class="row mt-3">
    <div class="col">
      <h2 class="d-flex justify-content-center mb-3">Realizar Reserva</h2>
      <label class="d-flex justify-content-center mb-3">Politicas de Reserva : La reserva de productos tiene una validez de dos semanas, los productos deben ser retirados en la sucursal, en los horarios de atencion y pagos en efectivo, gracias por preferirnos</label>
      <form method="POST" action="{{ action('ReservaController@store') }}" id="procesar-pago" name="procesar-pago">
        {{ csrf_field() }}
        <div class="form-group row">
          <label for="cliente" class="col-12 col-md-2 col-form-label h2">Cliente :</label>
          <div class="col-12 col-md-10">
            <input type="text" name="nombre" class="form-control" id="cliente"
            placeholder="Ingresa nombre cliente" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="email" class="col-12 col-md-2 col-form-label h2">Correo :</label>
          <div class="col-12 col-md-10">
            <input type="email" name="correo" class="form-control" id="correo" placeholder="Ingresa tu correo" required>
          </div>
        </div>

        <div id="carrito" class="table-responsive">
          <table class="table" id="lista-compra">
            <thead>
              <tr>
                <th scope="col">Imagen</th>
                <th scope="col">Nombre</th>
                <th scope="col">Precio</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Sub Total</th>
                <th scope="col">Eliminar</th>
              </tr>

            </thead>
            <tbody>

            </tbody>
            <tr>
              <th colspan="4" scope="col" class="text-right">TOTAL :</th>
              <th scope="col">
                <p id="total"></p>
                <input type="number" name="inputTotal" id="inputTotal" style="display:none">
              </th>
              <!-- <th scope="col"></th> -->
            </tr>
          </table>
        </div>
        <div class="row justify-content-center" id="loaders">
          <img id="cargando" src="/images/cargando.gif" width="220">
        </div>
        <div class="row justify-content-between">
          <div class="col-md-4 mb-2">
            <a href="categoria" class="btn btn-info btn-block">Seguir Seleccionando Productos</a>
          </div>
          <div class="col-xs-12 col-md-4">
            <button type="submit" class="btn btn-primary btn-block" id="procesar-compra">Realizar Reserva</button>
          </div>
        </div>
      </form>


    </div>


  </div>

</div>
<script type="text/javascript" src="/js/carrito.js"></script>
<script type="text/javascript" src="/js/reserva.js"></script>
