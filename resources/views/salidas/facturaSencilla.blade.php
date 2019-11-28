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
  <div id="factura-sencilla">
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
<td style="width: 318.462px;">       </td>
<td style="width: 60px;">{{ $ventas_gravadas }}</td>
</tr>
<tr>
<td style="width: 318.462px;"></td>
<td style="width: 60px;"></td>
</tr>
<tr>
<td style="width: 318.462px;"></td>
<td style="width: 60px;"></td>
</tr>
<tr>
<td style="width: 318.462px;"></td>
<td style="width: 60px;">{{ $subtotal }}</td>
</tr>
<tr>
<td style="width: 318.462px;"></td>
<td style="width: 60px;">{{ $subtotal }}</td>
</tr>
</tbody>
</table>
<table style="width: 382.375px;">
<tbody>
<tr>
<td style="width: 132px;">     </td>
<td style="width: 250.375px;">{{ $nombre }}</td>
</tr>
</tbody>
</table>
  </div>
  
</body>
</html>