<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Ficha</title>
</head>
<body>
<br><br><br>
<h1 p align="center">Magic Copy</p></h1>
<h2 p align="center">Transformamos tus ideas en papel</p></h2><br>
<h3 p align="center">Reporte de ficha tecnica</p></h3><br><br>
<table style="width: 556px;">
<tbody>
<tr style="height: 75px;">
<td style="width: 109px; height: 25px;"><b>&nbsp; Fecha:</td>
<td style="width: 300px; height: 25px;">&nbsp;{{$ticketPdf[0]->fecha_inicio}}</td>
<td style="width: 89px; height: 25px;"><b>&nbsp;Telefono:</td>
<td style="width: 109px; height: 25px;">&nbsp;{{$ticketPdf[0]->telefono}}</td>
</tr>
<tr style="height: 75px;">
<td style="width: 109px; height: 25px;"><b>&nbsp;Cliente:</td>
<td style="width: 300px; height: 25px;">&nbsp;{{$ticketPdf[0]->nom}} {{$ticketPdf[0]->apellido}}</td>
<td style="width: 89px; height: 25px;">&nbsp;</td>
<td style="width: 109px; height: 25px;">&nbsp;</td>
</tr>
<tr style="height: 75px;">
<td style="width: 109px; height: 25px;"><b>&nbsp;Direccion:</td>
<td style="width: 300px; height: 25px;">&nbsp;{{$ticketPdf[0]->direccion}}</td>
<td style="width: 89px; height: 25px;">&nbsp;</td>
<td style="width: 109px; height: 25px;">&nbsp;</td>
</tr>
<tr style="height: 75px;">
<td style="width: 109px; height: 25px;"><b>&nbsp;Equipo:</td>
<td style="width: 300px; height: 25px;">&nbsp;{{$ticketPdf[0]->cat}}</td>
<td style="width: 89px; height: 25px;">&nbsp;</td>
<td style="width: 109px; height: 25px;">&nbsp;</td>
</tr>
<tr style="height: 75px;">
<td style="width: 109px; height: 25px;"><b>&nbsp;Serie:</td>
<td style="width: 300px; height: 25px;">&nbsp;{{$ticketPdf[0]->serie}}</td>
<td style="width: 89px; height: 25px;"><b>&nbsp;Marca:</td>
<td style="width: 109px; height: 25px;">&nbsp;{{$ticketPdf[0]->marca}}</td>
</tr>
<tr style="height: 75px;">
<td style="width: 109px; height: 25px;"><b>&nbsp;Modelo:</td>
<td style="width: 300px; height: 25px;">&nbsp;{{$ticketPdf[0]->modelo}}</td>
<td style="width: 89px; height: 25px;"><b>&nbsp;Contador:</td>
<td style="width: 109px; height: 25px;">&nbsp;{{$ticketPdf[0]->contador}}</td>
</tr>
<tr style="height: 50px;">
<td style="width: 109px; height: 57px;"><b>Total:</td>
<td style="width: 300px; height: 57px;">&nbsp;{{$ticketPdf[0]->total}}</td>
<td style="width: 89px; height: 57px;">&nbsp;</td>
<td style="width: 109px; height: 57px;">&nbsp;</td>
</tr>
<tr style="height: 50px;">
<td style="width: 109px; height: 57px;"><b>&nbsp;Firma:</td>
<td style="width: 109px; height: 57px;">&nbsp;</td>
<td style="width: 109px; height: 57px;">&nbsp;</td>
<td style="width: 109px; height: 57px;">&nbsp;</td>
</tr>
<tr style="height: 176px;">
<td style="width: 109px; height: 176px;">&nbsp;<b>Observaciones:</td>
<td style="width: 109px; height: 176px;">&nbsp;</td>
<td style="width: 109px; height: 176px;">&nbsp;</td>
<td style="width: 109px; height: 176px;">&nbsp;</td>
</tr>
</tbody>
</table>
<!-- DivTable.com -->
</body>
</html>