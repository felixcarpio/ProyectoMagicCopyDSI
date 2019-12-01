@extends('layouts.app')
@section('nombre') Salida de producto
@endsection
@section('links')
<link rel="stylesheet" href="{{ asset('css/salida.css') }}">
@endsection
@section('content')
@auth
<h2>Verifique los datos de la venta</h2>
<form method="POST" action="{{ action('SalidaController@storeVenta') }}">
  {{ csrf_field() }}
  <b class="indicadores">Tipo de salida: </b>
  <input type="text" class="ocultar" name="tipo" id="tipo">
  <label class="datosVenta" id="labelTipo"></label>
  <b class="indicadores">Correlativo de factura: </b>
  <label class="" id="labelCorrelativo"></label>
  <input type="text" class="ocultar" name="correlativo_factura" id="correlativo_factura">
  <b class="indicadores">Fecha:</b>
  <label class="datosVenta" id="labelFecha"></label>
  <input type="text" class="ocultar" name="fecha_emision" id="fecha">
  <div id="contenedorPromocion"></div>
  <b class="indicadores">Total:</b>
  <label class="datosVenta" id="labelTotal"></label>
  <input type="text" class="ocultar" name="total" id="total">
  <b class="indicadores">Total con IVA:</b>
  <label class="datosVenta" id="labelTotalIva"></label>
  <input type="text" class="ocultar" name="total_iva" id="total_iva">
  <b class="indicadores">Tipo de factura:</b>
  <label class="" id="labelFactura"></label>
  <input type="text" class="ocultar" name="factura" id="factura">
  <div id="contenedorComprador"></div>
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
        <tbody id="tablebody">
        </tbody>
</table>
<button type="submit" name="action" value="generarFactura" class="btn btn-success" >Generar Factura</button>
<button type="submit" name="action" value="guardar" class="btn btn-success">Confirmar datos</button>
<!-- <button type="submit" class="btn btn-success">Datos correctos</button> -->
    <a href="/salida/venta" class="btn btn-danger">Regresar</a>
</form>

@section('script')
<script>
  const datos = {!! json_encode($datos->toArray()) !!}
  const datosProductos = {!! json_encode($datosProductos) !!}
  const tipoSalida = {!! json_encode($tipoSalida) !!}
  const productosPromocion = {!! json_encode($productosPromocion) !!}
  var totalVenta = 0
  var codigoHtml = ""

  if(datos.promocion != "Lista de Promociones"){
    const codigoPromocion = `<b class="indicadores">Promoción:</b>
    <label max-width="80%" id="labelPromocion">${datos.promocion}</label>
    <input type="text" class="ocultar" name="promocion" id="promocion">
    <b class="">Cantidad de promociones:</b>
    <label id="labelCantPromociones">${datos.cantidad_promociones}</label>
    <input type="text" class="ocultar" name="cantidad_promociones" id="cantidad_promociones">`
    $('#contenedorPromocion').append(codigoPromocion)
    datos.cantidad_promociones == null ? datos.cantidad_promociones = 1 : datos.cantidad_promociones = datos.cantidad_promociones

    // for(j=0; j< parseInt(datos.cantidad_promociones);j++){
    for(i=0;i<productosPromocion.length;i++){
      totalVenta += productosPromocion[i].precio_unitario * productosPromocion[i].cantidad * datos.cantidad_promociones
    var precioActual = productosPromocion[i].precio_unitario * productosPromocion[i].cantidad
    codigoHtml = ` <tr>
    <td align="center">${productosPromocion[i].nombre}
    <input type="text" class="ocultar producto" name="producto[]" id="productoPromo${i}"> 
    </td>
    <td align="center">${productosPromocion[i].cantidad * datos.cantidad_promociones}
    <input type="text" class="ocultar cantidad" name="cantidad[]" id="cantidadPromo${i}"> 
    </td>
    <td align="center">${productosPromocion[i].precio_unitario}
    <input type="text" class="ocultar precio" name="precio[]" id="precioPromo${i}"> 
    </td>
    <td align="center">${(precioActual * parseInt(datos.cantidad_promociones) ).toFixed(2)}
    <input type="text" class="ocultar totalProducto" name="totalProducto[]" id="totalProductoPromo${i}"> 
    </td>
    </tr>`
    $('#tablebody').append(codigoHtml)
    var prod = document.getElementById(`productoPromo${i}`).value = productosPromocion[i].nombre
    var cant = document.getElementById(`cantidadPromo${i}`).value = productosPromocion[i].cantidad * datos.cantidad_promociones
    var prec = document.getElementById(`precioPromo${i}`).value = productosPromocion[i].precio_unitario
    var totalProd = document.getElementById(`totalProductoPromo${i}`).value = (precioActual * parseInt(datos.cantidad_promociones)).toFixed(2)
    }
    const inputPromocion = document.getElementById('promocion').value = datos.promocion
    const inputCantidadPromociones = document.getElementById('cantidad_promociones').value = datos.cantidad_promociones
  }


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
    if(datos.cantidad[i] != 0){
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
  }

  var totalIva = totalVenta * 1.13

  const labelTipo = document.getElementById('labelTipo').textContent = tipoSalida[0].nombre
  const tipo = document.getElementById('tipo').value = tipoSalida[0].nombre
  const labelCorrelativo = document.getElementById('labelCorrelativo').textContent = datos.correlativo_factura
  const correlativo_factura = document.getElementById('correlativo_factura').value = datos.correlativo_factura
  const labelFecha = document.getElementById('labelFecha').textContent = datos.fecha_emision
  const fecha = document.getElementById('fecha').value = datos.fecha_emision
  const labelTotal = document.getElementById('labelTotal').textContent = (totalVenta).toFixed(2)
  const total = document.getElementById('total').value = (totalVenta).toFixed(2)
  const labelTotalIva = document.getElementById('labelTotalIva').textContent = (totalIva).toFixed(2)
  const totalConIva = document.getElementById('total_iva').value = (totalIva).toFixed(2)
  const labelFactura = document.getElementById('labelFactura').textContent = datos.factura
  const factura = document.getElementById('factura').value = datos.factura

  var codigoFactura = ""

  if(datos.factura == "Consumidor final"){
    codigoFactura = ` <b> Datos del cliente </b>
    <br>
    <b class="indicadores-cliente">Nombre:</b>
    <label class="datosCliente" id="labelNombreComprador">${datos.nombre_comprador}</label>
    <input type="text" class="ocultar" name="nombre_comprador" id="nombre_comprador">`
    $('#contenedorComprador').append(codigoFactura)
    const nombre = document.getElementById('nombre_comprador').value = datos.nombre_comprador
    if(datos.dui){
      codigoFactura = `<b class="indicadores-cliente">DUI:</b>
    <label class="datosCliente" id="labelNombreComprador">${datos.dui}</label>
    <input type="text" class="ocultar" name="dui" id="dui">`
    $('#contenedorComprador').append(codigoFactura)
    const dui = document.getElementById('dui').value = datos.dui
    }
    if(datos.direccion_comprador){
      codigoFactura = `<b class="indicadores-cliente">Direccion:</b>
    <label class="datosCliente" id="labeldireccion">${datos.direccion_comprador}</label>
    <input type="text" class="ocultar" name="direccion" id="direccion">`
    $('#contenedorComprador').append(codigoFactura)
    const direccion = document.getElementById('direccion').value = datos.direccion_comprador
    }
    if(datos.cuenta_comprador){
      codigoFactura = `<b class="indicadores-cliente">Cuenta:</b>
    <label class="datosCliente" id="labelCuenta">${datos.cuenta_comprador}</label>
    <input type="text" class="ocultar" name="cuenta" id="cuenta">`
    $('#contenedorComprador').append(codigoFactura)
    const cuenta = document.getElementById('cuenta').value = datos.cuenta_comprador
    }    
  } else if (datos.factura == "Sencilla"){
    codigoFactura = ` <b> Datos del cliente </b>
    <br>
    <b class="indicadores-cliente">Nombre:</b>
    <label class="datosCliente" id="labelNombreComprador">${datos.nombre_comprador}</label>
    <input type="text" class="ocultar" name="nombre_comprador" id="nombre_comprador">`
    $('#contenedorComprador').append(codigoFactura)
    const nombre = document.getElementById('nombre_comprador').value = datos.nombre_comprador
  } else if (datos.factura == "Crédito fiscal"){
    codigoFactura = ` <b> Datos del cliente </b>
    <br>
    <b class="indicadores-cliente">Nombre de empresa:</b>
    <label class="" id="labelEmpresa">${datos.entidad}</label>
    <input type="text" class="ocultar" name="entidad" id="entidad">`
    $('#contenedorComprador').append(codigoFactura)
    const entidad = document.getElementById('entidad').value = datos.entidad
  }
  
  
</script>
@endsection
@endsection
@endauth