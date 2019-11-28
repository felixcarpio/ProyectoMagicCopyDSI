<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Factura</title>
  <link rel="stylesheet" href="/css/factura.css">
</head>

<body>
  <br> <br> <br> <br> <br> <br> <br>
  <div id="">
    <table style="width: 392px; height: 19px;">
      <tbody>
        <tr>
          <td style="width: 295.377px;">&nbsp;</td>
          <td style="width: 30.6226px;">{{$data['dia']}}</td>
          <td style="width: 32px;">{{$data['mes']}}</td>
          <td style="width: 32px;">{{ $data['anio'] }}</td>
        </tr>
      </tbody>
    </table>
    <br>
    <table style="height: 93px; width: 380px;">
      <tbody>
        <tr>
          <td style="width: 50.462px;">&nbsp;</td>
          <td style="width: 60px;">{{ $data['nombre'] }}</td>
        </tr>
        <tr>
          <td style="width: 50.462px;">&nbsp;</td>
          <td style="width: 60px;">{{ $data['dui'] }}</td>
        </tr>
        <tr>
          <td style="width: 50.462px;">&nbsp;</td>
          <td style="width: 60px;">{{ $data['direccion'] }}</td>
        </tr>
        <tr>
          <td style="width: 50.462px;">&nbsp;</td>
          <td style="width: 60px;">{{ $data['cuenta'] }}</td>
        </tr>
      </tbody>
    </table>
    <br> <br>
    <table style="">
      <tbody>
        @foreach($data['producto'] as $clave => $valor)
        <tr>
          <td style="width: 66px;">{{ $data['cantidad'][$clave] }}</td>
          <td style="width: 327.406px;">{{ $data['producto'][$clave] }}</td>
          <td style="width: 40.5938px;">{{ $data['precio'][$clave] }}</td>
          <td style="width: 50px;">&nbsp;</td>
          <td style="width: 52px;">&nbsp;</td>
          <td style="width: 73px;">{{ $data['totalProducto'][$clave] }}</td>
        </tr>

        @endforeach


      </tbody>
    </table>
  </div>
  <div id="abajo">
    <h2>hola</h2>
  </div>

</body>

</html>