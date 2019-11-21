@extends('layouts.app')
@section('nombre') Salida de producto
@endsection
@section('links')
<link rel="stylesheet" href="{{ asset('css/salida.css') }}">
@endsection
@section('content')
@auth
<h2>Verifique los datos de la salida de productos</h2>
<form method="POST" action="{{ action('SalidaController@store') }}">
  {{ csrf_field() }}
  <b class="indicadores">Tipo de salida: </b>
  <label class="datosVenta" id="labelTipo"></label>
  <input type="text" class="ocultar" name="tipo" id="tipo">
  <b class="indicadores">Fecha:</b>
  <label class="datosVenta" id="labelFecha"></label>
  <input type="text" class="ocultar" name="fecha_emision" id="fecha">
  <div id="contenedorComentarios"></div>
  <b class="indicadores">Total:</b>
  <label class="datosVenta" id="labelTotal"></label>
  <input type="text" class="ocultar" name="total" id="total">
  <br> <br>
  <b class="indicadores">Productos </b>
  <br> <br>
  <table id="tabla" class="table table-light">
        <thead class="table-dark">
          <tr align="center">
            <th scope="col" class="colorth"> Producto </th>
            <th scope="col" class="colorth">Cantidad  </th>
            <th scope="col" class="colorth">Precio</th>
            <th scope="col" class="colorth">Total</th>
          </tr>
        </thead>
        <tbody id="tablebody"></tbody>
</table>
<button type="submit" class="btn btn-success">Datos correctos</button>
    <a href="/salida" class="btn btn-danger">Regresar</a>
</form>

@section('script')
<script>
  const datos = {!! json_encode($datos->toArray()) !!}
  const datosProductos = {!! json_encode($datosProductos) !!}
  const tipoSalida = {!! json_encode($tipoSalida) !!}
  var totalVenta = 0
  var codigoHtml = ""

  for(i=0;i<datosProductos.length;i++){
    codigoHtml = ` <tr>
    <td align="center">${datosProductos[i][0].nombre}
    <input type="text" class="ocultar producto" name="producto[]" id="producto${i}"> 
    </td>
    <td align="center">${datos.cantidad[i]}
    <input type="text" class="ocultar cantidad" name="cantidad[]" id="cantidad${i}"> 
    </td>`
    if(datosProductos[i][0].precio_con_descuento){
      codigoHtml += 
      `<td align="center">${datosProductos[i][0].precio_con_descuento}
      <input type="text" class="ocultar precio" name="precio[]"   id="precio${i}"> 
      </td>`
      var precioActual = datosProductos[i][0].precio_con_descuento * parseInt(datos.cantidad[i])
      totalVenta += datosProductos[i][0].precio_con_descuento * parseInt(datos.cantidad[i])
    } else {
      codigoHtml += 
      `<td align="center">${datosProductos[i][0].precio}
      <input type="text" class="ocultar precio" name="precio[]" id="precio${i}"> 
      </td>`
      var precioActual = datosProductos[i][0].precio * parseInt(datos.cantidad[i])
      totalVenta += datosProductos[i][0].precio * parseInt(datos.cantidad[i])
    }
    codigoHtml += `<td align="center">${precioActual.toFixed(2)}
    <input type="text" class="ocultar totalProducto" name="totalProducto[]" id="totalProducto${i}"> 
    </td>
    </tr>`
    $('#tablebody').append(codigoHtml)
    var prod = document.getElementById(`producto${i}`).value = datosProductos[i][0].nombre
    var cant = document.getElementById(`cantidad${i}`).value = datos.cantidad[i]
    if(datosProductos[i][0].precio_con_descuento){
      var prec = document.getElementById(`precio${i}`).value = datosProductos[i][0].precio_con_descuento
    } else {
    var prec = document.getElementById(`precio${i}`).value = datosProductos[i][0].precio
    }
    var totalProd = document.getElementById(`totalProducto${i}`).value = precioActual.toFixed(2)
  }

  const labelTipo = document.getElementById('labelTipo').textContent = tipoSalida[0].nombre
  const tipo = document.getElementById('tipo').value = tipoSalida[0].nombre
  const labelFecha = document.getElementById('labelFecha').textContent = datos.fecha_emision
  const fecha = document.getElementById('fecha').value = datos.fecha_emision
  const labelTotal = document.getElementById('labelTotal').textContent = totalVenta.toFixed(2)
  const total = document.getElementById('total').value = totalVenta.toFixed(2)

  if(datos.comentario){
    const comentario = `<b class="indicadores">Comentarios:</b>
    <label max-width="80%" id="comment">${datos.comentario}</label>
    <input type="text" class="ocultar" name="comentario" id="comentario">`
    $('#contenedorComentarios').append(comentario)
    const inputComentario = document.getElementById('comentario').value = datos.comentario
  }
</script>
@endsection
@endsection
@endauth