<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <h1 align="center" >Reporte de ventas del año {{$anio}}</h1>
<table>
<thead class="table-dark">
  <tr align="center"> 
    <th width="150px" scope="col" class="colorth" align="center">Fecha</th>
    <th width="100px" scope="col" class="colorth" align="center">Correlativo</th>
    <th width="100px" scope="col" class="colorth" align="center">Tipo de Factura</th>
    <th width="150px" scope="col" class="colorth" align="center">Total</th>
    <th width="150px" scope="col" class="colorth" align="center">Total con IVA</th>
  </tr>
</thead>
<tbody id="tabla">
  @if($ventas)
  @foreach($ventas as $clave => $valor)
  <tr>
  <td align="center">{{ date('d/m/Y', strtotime($ventas[$clave]->fecha_emision)) }}</td>
  <td align="center">{{$ventas[$clave]->correlativo_factura}}</td>
  <td align="center">{{$ventas[$clave]->tipo_factura}}</td>
  <td align="center"> {{$ventas[$clave]->total}}</td>
  <td align="center"> {{$ventas[$clave]->total_iva}} </td>
</tr>

@endforeach
@else
<h6>No existen datos de inventario</h6>
@endif
</tbody>
</table>
</body>
</html>