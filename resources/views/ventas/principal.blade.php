<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="/css/style-mc.css" rel="stylesheet" >
    <title>Principal</title>
</head>
<body>
  <div class="container contenedor">
    <div class="cotizacion">
      <div class="tituloCotizacion">
          <h1>Cotizaciones</h1>
      </div>
      <form action="{{ action('ProductoController@store') }}" method="POST" enctype="multipart/form-data">
          <div>
            {{ csrf_field() }}

              <div class="form-group">
                <label>Nombre Completo</label>
                <input type="text" name="nombre" class="form-control" placeholder="Ingrese su Nombre Completo">
              </div>

              <div class="form-group">
                <label>Correo</label>
                <input type="tect" name="correo" class="form-control" placeholder="Ingrese su correo">
              </div>

              <div class="form-group">
                <label>Descripcion</label>
                <input type="text" name="descripcion" class="form-control" placeholder="Ingrese la descripcion de su cotizacion">
              </div>

              <div class="form-group">
                <label>Telefono</label>
                <input type="tel" pattern="[0-9]{8}" name="telefono" class="form-control" placeholder="Ingrese el telefono del proveedor">
              </div>

              <div class="form-group">
                <label>Imagen</label>
                <input type="file" name="imagen"  placeholder="Ingrese imagen">
              </div>

          <div>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </form>
    </div>

  </div>
</div>

</body>
</html>
