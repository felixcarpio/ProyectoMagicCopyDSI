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
  <div style="height: 600px;">
    <table style="width: 392px; height: 19px;">
      <tbody>
        <tr>
          <td style="width: 295.377px;">&nbsp;</td>
          <td style="width: 30.6226px;">{{$dia}}</td>
          <td style="width: 32px;">{{$mes}}</td>
          <td style="width: 32px;">{{ $anio }}</td>
        </tr>
      </tbody>
    </table>
    <br>
    <table style="height: 93px; width: 380px;">
      <tbody>
        <tr>
          <td style="width: 50.462px;">&nbsp;</td>
          <td style="width: 60px;">{{ $nombre }}</td>
        </tr>
        <tr>
          <td style="width: 50.462px;">&nbsp;</td>
          <td style="width: 60px;">{{ $dui }}</td>
        </tr>
        <tr>
          <td style="width: 50.462px;">&nbsp;</td>
          <td style="width: 60px;">{{ $direccion }}</td>
        </tr>
        <tr>
          <td style="width: 50.462px;">&nbsp;</td>
          <td style="width: 60px;">{{ $cuenta }}</td>
        </tr>
      </tbody>
    </table>
    <br> <br>
    <table style="">
      <tbody>
        @foreach($producto as $clave => $valor)
        <tr>
          <td style="width: 66px;">{{ $cantidad[$clave] }}</td>
          <td style="width: 327.406px;">{{ $producto[$clave] }}</td>
          <td style="width: 40.5938px;">{{ $precio[$clave] }}</td>
          <td style="width: 50px;">&nbsp;</td>
          <td style="width: 52px;">&nbsp;</td>
          <td style="width: 73px;">{{ $totalProducto[$clave] }}</td>
        </tr>

        @endforeach


      </tbody>
    </table>
  </div>
  <div id="abajo">
  <table style="height: 146px; width: 741px;">
<tbody>
<tr style="height: 23px;">
<td style="width: 220px; height: 23px;">&nbsp;</td>
<td style="width: 123px; height: 23px;">&nbsp;</td>
<td style="width: 59px; height: 23px;">&nbsp;</td>
<td style="width: 57px; height: 23px;">&nbsp;</td>
<td style="width: 151px; height: 23px;">{{ $sumas }}</td>
</tr>
<tr style="height: 23px;">
<td style="width: 220px; height: 23px;">&nbsp;</td>
<td style="width: 123px; height: 23px;">&nbsp;</td>
<td style="width: 59px; height: 23px;">&nbsp;</td>
<td style="width: 57px; height: 23px;">&nbsp;</td>
<td style="width: 151px; height: 23px;">{{ $iva }}</td>
</tr>
<tr style="height: 23px;">
<td style="width: 220px; height: 23px;">&nbsp;</td>
<td style="width: 123px; height: 23px;">&nbsp;</td>
<td style="width: 59px; height: 23px;">&nbsp;</td>
<td style="width: 57px; height: 23px;">&nbsp;</td>
<td style="width: 151px; height: 23px;">{{ $subtotal }}</td>
</tr>
<tr style="height: 23px;">
<td style="width: 220px; height: 23px;">&nbsp;</td>
<td style="width: 123px; height: 23px;">&nbsp;</td>
<td style="width: 59px; height: 23px;">&nbsp;</td>
<td style="width: 57px; height: 23px;">&nbsp;</td>
<td style="width: 151px; height: 23px;">&nbsp;</td>
</tr>
<tr style="height: 23px;">
<td style="width: 220px; height: 23px;">&nbsp;</td>
<td style="width: 123px; height: 23px;">&nbsp;</td>
<td style="width: 59px; height: 23px;">&nbsp;</td>
<td style="width: 57px; height: 23px;">&nbsp;</td>
<td style="width: 151px; height: 23px;">&nbsp;</td>
</tr>
<tr style="height: 23px;">
<td style="width: 220px; height: 23px;">&nbsp;</td>
<td style="width: 123px; height: 23px;">&nbsp;</td>
<td style="width: 59px; height: 23px;">&nbsp;</td>
<td style="width: 57px; height: 23px;">&nbsp;</td>
<td style="width: 151px; height: 23px;">{{ $subtotal }}</td>
</tr>
</tbody>
</table>
  </div>

</body>

</html>