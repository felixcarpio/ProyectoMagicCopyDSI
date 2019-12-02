<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <h1 align="center" >Inventario de {{$producto}} en {{$anio}}</h1>
<table>
<thead class="table-dark">
  <tr align="center"> 
    <th width="150px" scope="col" class="colorth" align="center">Fecha</th>
    <th width="100px" scope="col" class="colorth" align="center">Producto</th>
    <th width="100px" scope="col" class="colorth" align="center">Cantidad</th>
    <th width="150px" scope="col" class="colorth" align="center">Costo</th>
    <th width="150px" scope="col" class="colorth" align="center">Existencias/th>
  </tr>
</thead>
<tbody id="tabla">
  @if($inventario)
  @foreach($inventario as $clave => $valor)
  <tr>
  <td align="center">{{ date('d/m/Y', strtotime($inventario[$clave]->fecha)) }}</td>
  <td align="center">{{$inventario[$clave]->nombre}}</td>
  <td align="center">{{$inventario[$clave]->cantidad}}</td>
  <td align="center"> {{$inventario[$clave]->costo}}</td>
  <td align="center"> {{$inventario[$clave]->existencias}} </td>
</tr>

@endforeach
@else
<h6>No existen datos de inventario</h6>
@endif
</tbody>
</table>
</body>
</html>