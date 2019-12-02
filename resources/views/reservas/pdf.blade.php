<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport"
  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/estilo.css">
  <script src="js/popper.min.js"></script>
</head>

<body>
  <br>

  <main>
    <div class="container">
      <div class="row mt-2">
        <div class="col">
          <h2 class="d-flex justify-content-center mb-1" >Detalle de Reserva</h2>
          <label class="justify-content-center mb-3" style="width:400px;display:block">Politicas de Reserva : 
            La reserva de productos tiene una validez de dos semanas, los productos deben ser retirados en la sucursal, en los horarios de atencion y pagos en efectivo, gracias por preferirnos</label>
          <form id="procesar-pago" action="#">
            <div class="form-group row">
              <label for="cliente" class="col-12 col-md-2 col-form-label h2">Cliente :</label>
              <div class="col-12 col-md-10">
                <input type="text" class="form-control" id="cliente"
                placeholder="Ingresa nombre cliente" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="email" class="col-12 col-md-2 col-form-label h2">Correo :</label>
              <div class="col-12 col-md-10">
                <input type="email" class="form-control" id="correo" placeholder="Ingresa tu correo" required>
              </div>
            </div>

            <div id="carrito" class="table-responsive">
              <table class="table" id="lista-compra">
                <thead>
                  <tr>
                    {{-- <th scope="col">Imagen</th> --}}
                    <th scope="col">Nombre</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Sub Total</th>
                    {{-- <th scope="col">Eliminarr</th> --}}
                  </tr>

                </thead>
                <tbody>
                  @foreach ($reservaProductos as $reservaProducto)
                    <tr>
                      {{-- <td>{{$reservaProducto->imagen}}</td> --}}
                      <td>{{$reservaProducto->nombre}}</td>
                      @if($reservaProducto->precio_con_descuento != NULL)
                        <td>{{$reservaProducto->precio_con_descuento}}</td>
                      @else
                        <td>{{$reservaProducto->precio}}</td>
                     @endif
                      <td>{{$reservaProducto->cantidad_ordenada}}</td>
                      <td>{{$reservaProducto->sub_total}}</td>
                    </tr>

                  @endforeach

                </tbody>
                <tr>
                  <th colspan="4" scope="col" class="text-right">TOTAL :</th>
                  <th scope="col">
                    <p id="total">
                      @foreach ($reservas as $reserva)
                      <td>{{$reserva->precio_sin_descuento}}</td>
                    @endforeach</p>
                    </p>
                  </th>
                  <!-- <th scope="col"></th> -->
                </tr>

              </table>
              <div class="justify-content-center mb-3" style="width:400px;display:block">
                <br>
                Sucursal: Avenida L-C Poligono A, Cd Merliot
                <br>
                <br>
                Horario:
                <br>
                Lunes a Viernes 6:00-18:00
                <br>
                Sabado          6:00-18:00
                <br>
                Domingo Cerrado
                <br>
                <br>
                email: magiccopysv@gmail.com
                telefono: 2278-1886
              </div>
              <a href="/pdfImpreso">Crear PDf</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</main>
</div>
</body>
</html>
