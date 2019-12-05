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
          <h1 class="d-flex justify-content-center mb-3" >Magic Copy</h1>
          <h2 class="d-flex justify-content-center mb-3" >Detalle de Reserva</h2>
          <label class="justify-content-center mb-3" style="width:525px;display:block">Politicas de Reserva : 
            La reserva de productos tiene una validez de dos semanas, los productos deben ser retirados en la sucursal, en los horarios de atencion y pagos en efectivo, gracias por preferirnos</label>
          <form id="procesar-pago" action="#">
            <br>
            <div class="form-group row" style="width:525px;display:block">
              <label  style="width:525px;display:block" for="cliente" class="col-12 col-md-2 col-form-label h2">Cliente:</label>
              <div class="col-12 col-md-10" style="width:525px;display:block">
                @foreach ($reservas as $reserva)
                <p>{{$reserva->nombre}}</p>
                @endforeach
            </div>
            <div class="form-group row" style="width:525px;display:block"> 
              <label for="email"  style="width:525px;display:block" class="col-12 col-md-2 col-form-label h2">Correo :</label>
              <div class="col-12 col-md-10" style="width:525px;display:block">
                  @foreach ($reservas as $reserva)
                  <p>{{$reserva->correo_comprador}}</p>
                @endforeach  
              
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
              <div class="justify-content-center mb-3" style="width:500px;display:block">
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
                Email: magiccopysv@gmail.com
                Telefono: 2278-1886
              </div>
              @foreach ($reservas as $reserva)
              <a href="/pdfImpresoReserva/{{$reserva->codigo_reserva}}">Crear PDf</a>
              @endforeach
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
