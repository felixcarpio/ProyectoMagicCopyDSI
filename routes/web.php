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
Route::post('/inventario','InventarioController@getPedidosDelProducto');
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
Route::get('/crearcotizacion', 'CotizacionController@create')->name('cotizacion.crear');
Route::get('/crearcotizacion', 'PromocionController@mostrar')->name('promocion.mostrar');

// ------------------RUTA COTIZACION EVENTO -------------------

Route::get('/evento', 'EventoController@index');
Route::post('eventoPrincipal/store', 'EventoController@store')->name('evento.almacenar');
Route::get('/eventoPrincipal', 'EventoController@create')->name('evento.principal');



// -----------------------RUTAS RESERVAS -------------------------------

Route::get('/reservas', 'ReservaController@index');
Route::put('reservas/{reserva}', 'ReservaController@update')->name('reserva.actualizar');
Route::delete('/reservas/{reserva}','ReservaController@destroy')->name('reserva.eliminar');
Route::get('/reservas/{reserva}','ReservaController@show')->name('reserva.mostrar');
Route::get('/reserva/categoria','ReservaController@reservaCategoria')->name('reserva.categoria.mostrar');
Route::get('/reserva/reservaConfirmacion', 'ReservaController@create')->name('reserva.guardar');
Route::post('/reserva/pdf','ReservaController@store')->name('reserva.almacenar');
Route::get('pdfImpreso','ReservaController@generatePDF58');
Route::get('/reserva/pdf/ver', 'ReservaController@datosPDF');

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

// ------------- RUTAS CLIENTES -----------------
Route::resource('clientes','ClienteController');






Route::get('/contac/ingresar', 'ContactoController@ingresar')->name('contacto.ingresarc');
Route::put('/contac/ingresar', 'ContactoController@store');
Route::get('/contac/{contacto}','ContactoController@show')->name('contacto.ver');
Route::get('/contac/editar/{contacto}', 'ContactoController@actualizar')->name('contacto.actualizar');
Route::put('/contac/editar/{contacto}', 'ContactoController@update')->name('contacto.update');
