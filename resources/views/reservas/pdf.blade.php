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
      <div class="row mt-3">
        <div class="col">
          <h2 class="d-flex justify-content-center mb-3">Realizar Reserva</h2>
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
                    <th scope="col">Imagen</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Sub Total</th>
                    <th scope="col">Eliminarr</th>
                  </tr>

                </thead>
                <tbody>
                  @foreach ($reservaProductos as $reservaProducto)
                    <tr>
                      <td>{{$reservaProducto->imagen}}</td>
                      <td>{{$reservaProducto->nombre}}</td>
                      <td>{{$reservaProducto->precio}}</td>
                      <td>1</td>
                    </tr>

                  @endforeach



                </tbody>
                <tr>
                  <th colspan="4" scope="col" class="text-right">SUB TOTAL :</th>
                  <th scope="col">
                    <p id="subtotal"></p>
                  </th>
                  <!-- <th scope="col"></th> -->
                </tr>
                <tr>
                  <th colspan="4" scope="col" class="text-right">IVA :</th>
                  <th scope="col">
                    <p id="igv">

                  </th>
                  <!-- <th scope="col"></th> -->
                </tr>
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
