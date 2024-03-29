<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/ 

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
Route::resource('roles','RolController');
Route::resource('users','UserController');
Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/producto','ProductoController');
Route::get('/producto/{producto}','ProductoController@show')->name('producto.mostrar');
Route::resource('/marca','MarcaController');
Route::delete('/marca/{marca}','MarcaController@destroy')->name('marca.eliminar');
Route::resource('/proveedor','ProveedorController');


// ------------ RUTAS INVENTARIO ------------
Route::get('/inventario','InventarioController@index')->name('inventario');
Route::get('/verpedidos','PedidoController@mostrarPedidos')->name('pedidos');
Route::get('/verpedidos/{pedido}','PedidoController@show')->name('pedido.ver');
Route::post('/inventario','InventarioController@inventarioDelProducto');
Route::get('/pedido', 'PedidoController@index')->name('pedido');
Route::post('/pedido','PedidoController@getProductosProveedor');
Route::post('/pedido/crear','PedidoController@store');
Route::get('/recepcion','RecepcionController@index');
Route::post('/recepcion','RecepcionController@getProductosPedido');
Route::post('/recepcion/crear','RecepcionController@store');
Route::resource('/eliminarpedido', 'PedidoController');

// ------------ RUTAS COTIZACION -------------------------

Route::resource('/principal','CotizacionController');
Route::get('/cotizaciones', 'CotizacionController@index');
Route::delete('/cotizaciones/{cotizacion}','CotizacionController@destroy')->name('cotizacion.eliminar');
Route::get('/cotizaciones/{cotizacion}','CotizacionController@show')->name('cotizacion.mostrar');
Route::get('/cotizaciones/{evento}','CotizacionController@show')->name('evento.mostrar');
Route::get('/libreria', 'CotizacionController@create')->name('cotizacion.crear');
Route::get('/libreria', 'PromocionController@mostrar')->name('promocion.mostrar');

// ------------------RUTA COTIZACION EVENTO -------------------

Route::get('/evento', 'EventoController@index');
Route::post('eventoPrincipal/store', 'EventoController@store')->name('evento.almacenar');
Route::get('/eventoPrincipal', 'EventoController@create')->name('evento.principal');



// -----------------------RUTAS RESERVAS -------------------------------

Route::get('/reservas', 'ReservaController@index');
Route::put('reservas/{reserva}', 'ReservaController@update')->name('reserva.actualizar');
Route::get('/reservas/{reserva}','ReservaController@show')->name('reserva.mostrar');
Route::delete('/reservas/{reserva}','ReservaController@destroy')->name('reserva.elimina');
Route::get('/reserva/categoria','ReservaController@reservaCategoria')->name('reserva.categoria.mostrar');
Route::get('/reserva/categoriaUnica/{tipo}','ReservaController@reservaCategoriaUnica')->name('reserva.categoria.mostrar.unica');
Route::get('/reserva/reservaConfirmacion', 'ReservaController@create')->name('reserva.guardar');

Route::post('/reserva/pdf','ReservaController@store')->name('reserva.almacenar');
Route::get('/reserva/pdf/ver', 'ReservaController@datosPDF');
Route::get('pdfImpreso','ReservaController@generatePDF58');

Route::get('/reserva/pdf/ver/{reserva}', 'ReservaController@datosPDFReserva');
Route::get('pdfImpresoReserva/{reserva}','ReservaController@generatePDF58Reserva');

// Route::get('pdfImpreso', function(){
//   $pdf = PDF::loadView('reservas.pdf');
//   return $pdf->download('archivo.pdf');
// });


// ------------- RUTAS PROMOCIONES -------------
Route::resource('/promocion', 'PromocionController');
Route::get('/promocion/{promocion}','PromocionController@show')->name('promocion.ver');
Route::get('/promo/ingresar', 'PromocionController@ingresar')->name('promocion.ingresar');
Route::put('/promo/ingresar', 'PromocionController@store');
Route::get('/promocion/editar/{promocion}', 'PromocionController@actualizar')->name('promocion.actualizar');
Route::put('/promocion/editar/{promocion}', 'PromocionController@update')->name('promocion.update');

// ------------- RUTAS SALIDAS ----------------
Route::resource('/tipo','TipoController');
Route::resource('/entidad', 'EntidadController');
Route::get('/salida/venta', 'SalidaController@indexVenta');
Route::get('/versalidas', 'SalidaController@verSalidas');
Route::post('/salida/venta/verificar', 'SalidaController@verificarVenta');
Route::post('/salida/venta/guardar', 'SalidaController@storeVenta');
Route::post('/salida/venta','EntidadController@storeEnVenta');
Route::post('/salida/verificar', 'SalidaController@verificarSalida');
Route::post('/salida/guardar', 'SalidaController@store');
Route::resource('/salida', 'SalidaController');
Route::get('/versalidas/{pedido}','SalidaController@show')->name('salida.ver');
Route::get('/facturaSencilla','SalidaController@generarFacturaSencilla')->name('facturaSencilla'); 
Route::get('/facturaConsumidorFinal','SalidaController@generarFacturaConsumidorFinal')->name('facturaConsumidorFinal'); 
Route::get('/creditoFiscal','SalidaController@generarCreditoFiscal')->name('creditoFiscal'); 
Route::get('/pdfventas','SalidaController@generarReporteVentas')->name('reporteVentas'); 


// -------------- RUTAS MAQUINAS -------------
Route::resource('/maquina','MaquinaController');
Route::get('/maquina/{maquina}','MaquinaController@show')->name('maquinas.mostrar');
Route::resource('/categoria','CategoriaController');

// ------------ RUTAS CONTACTOS -------------------------
Route::resource('/contacto','ContactoController');
Route::resource('/empresa','EmpresaController');
Route::resource('/telefono','TelefonoController');

// ------------- RUTAS TICKETS ----------------
Route::resource('tickets','TicketController');

// ------------- RUTAS PIEZAS -----------------
Route::resource('piezas','PiezaController');
Route::get('/piezas/agregarPieza/{id}','PiezaController@create')->name('piezas.crear');

// ------------- RUTAS CLIENTES -----------------
Route::resource('clientes','ClienteController');

// -------------- RUTAS REPORTES ----------------
Route::get('/reporteventas', 'SalidaController@ObtenerTotalVentasAnioActual');
Route::post('/reporteventas', 'SalidaController@obtenerVentas');
Route::get('/reporteInventario', 'InventarioController@indexReporte');
Route::post('/reporteInventario', 'InventarioController@reporteInventario');
Route::get('/pdfInventario','InventarioController@generarReporteInventario')->name('reporteInventario');
Route::get('/reportes', function () { 
  return view('reportes');
});

Route::resource('/imagenes_evento','ImagenEventoController');

Route::get('/ticketPDF/{id}', 'TicketController@pdf')->name('tickets.pdf');

