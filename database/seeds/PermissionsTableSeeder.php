<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;
class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //TABLA USER
        Permission::create([
        	'name'         => 'Permiso de Entrada a lista de Usuarios',
        	'slug'         => 'user.index',
        	'description'  => 'Lista y Navega todos los usuarios del Sistema'
        ]);

        Permission::create([
        	'name' => 'Permiso de Creacion de Usuarios',
        	'slug' => 'user.store',
        	'description' => 'Crear nuevos usuarios en el Sistema'
        ]);

        Permission::create([
        	'name' => 'Permiso de Ver Usuarios',
        	'slug' => 'user.show',
        	'description' => 'Ver descripcion de usuarios en el Sistema'
        ]);

        Permission::create([
        	'name' => 'Permiso de Editar Usuarios',
        	'slug' => 'user.edit',
        	'description' => 'Editar usuarios del Sistema'
        ]);

        Permission::create([
        	'name' => 'Permiso de Eliminar Usuarios',
        	'slug' => 'user.destroy',
        	'description' => 'Eliminar usuarios del Sistema'
        ]);


        //TABLA ROLES
        Permission::create([
            'name' => 'Permiso de Entrada a lista de Roles',
            'slug' => 'rol.index',
            'description' => 'Lista y Navega todos los roles del Sistema'
        ]);
        
        Permission::create([
            'name' => 'Permiso de Creacion de Roles',
            'slug' => 'rol.store',
            'description' => 'Crear nuevos roles en el Sistema'
        ]);

        Permission::create([
            'name' => 'Permiso de Ver Roles',
            'slug' => 'rol.show',
            'description' => 'Ver descripcion de roles en el Sistema'
        ]);

        Permission::create([
            'name' => 'Permiso de Editar Roles',
            'slug' => 'rol.edit',
            'description' => 'Editar roles del Sistema'
        ]);

        Permission::create([
            'name' => 'Permiso de Eliminar Roles',
            'slug' => 'rol.destroy',
            'description' => 'Eliminar roles del Sistema'
        ]);

        //TABLA PRODUCTOS
        Permission::create([
            'name' => 'Permiso de Entrada a la lista de productos',
            'slug' => 'productos.index',
            'description' => 'Navegar por productos'
        ]);

        Permission::create([
            'name' => 'Permiso de Guardar productos',
            'slug' => 'productos.store',
            'description' => 'Guardar productos'
        ]);

        Permission::create([
            'name' => 'Permiso de Mostrar un producto',
            'slug' => 'producto.mostrar',
            'description' => 'Ver un productos'
        ]);

        Permission::create([
            'name' => 'Permiso de actualiar un producto',
            'slug' => 'producto.update',
            'description' => 'Actualizar un productos'
        ]);

        Permission::create([
            'name' => 'Permiso de eliminar un producto',
            'slug' => 'producto.destroy',
            'description' => 'Eliminar productos'
        ]);

        //TABLA MARCA
        Permission::create([
            'name' => 'Permiso de Entrada a la lista de marcas',
            'slug' => 'marca.index',
            'description' => 'Navegar por marcas'
        ]);

        Permission::create([
            'name' => 'Permiso de ingresar una marca',
            'slug' => 'marca.store',
            'description' => 'Crear nueva marca'
        ]);

        Permission::create([
            'name' => 'Permiso de actualiar una marca',
            'slug' => 'marca.update',
            'description' => 'Actualizar una marca'
        ]);

        Permission::create([
            'name' => 'Permiso de eliminar una marca',
            'slug' => 'marca.eliminar',
            'description' => 'Eliminar una marca'
        ]);

        //INVENTARIO
        Permission::create([
            'name' => 'Permiso de Entrada a la lista de inventario',
            'slug' => 'inventario.index',
            'description' => 'Navegar en el listado de inventario'
        ]);

        Permission::create([
            'name' => 'Permiso de Entrada de pedido de producto',
            'slug' => 'inventario.getPedidosDelProducto',
            'description' => 'Obtener el pedido del producto'
        ]);             

        //PEDIDO
        Permission::create([
            'name' => 'Permiso de mostrar pedidos',
            'slug' => 'pedidos.pedidos',
            'description' => 'Mostrar el listado de pedidos'
        ]);

        Permission::create([
            'name' => 'Permiso de ver un pedido',
            'slug' => 'pedido.ver',
            'description' => 'Ver un pedido'
        ]);

        Permission::create([
            'name' => 'Permiso de navegar en listado de pedidos',
            'slug' => 'pedido.pedido',
            'description' => 'Navegar por lista de pedidos',
        ]);

        Permission::create([
            'name' => 'Permiso de obtener producto-proveedor',
            'slug' => 'pedido.getProductosProveedor',
            'description' => 'Obtener producto-proveedor'
        ]);

        Permission::create([
            'name' => 'Permiso de crear pedido',
            'slug' => 'pedido.store',
            'description' => 'Crear un pedido'
        ]);

        Permission::create([
            'name' => 'Permiso de eliminar pedido',
            'slug' => 'pedido.destroy',
            'description' => 'Navegar en obtener pedido'
        ]);

        //RECEPCION
        Permission::create([
            'name' => 'Permiso de navegar en listado de recepcion',
            'slug' => 'recepcion.index',
            'description' => 'Navegar en listado de recepcion'
        ]);

        Permission::create([
            'name' => 'Permiso de navegar en obtener pedido',
            'slug' => 'recepcion.getProductosPedido',
            'description' => 'Navegar en obtener pedido'
        ]);

        Permission::create([
            'name' => 'Permiso de crear recepcion',
            'slug' => 'recepcion.store',
            'description' => 'Crear recepcion de pedido'
        ]);

        //COTIZACIONES
        Permission::create([
            'name' => 'Permiso de navegar en las cotizaciones',
            'slug' => 'cotizaciones.index',
            'description' => 'Navegar en las cotizaciones'
        ]);

        Permission::create([
            'name' => 'Permiso de eliminar cotizaciones',
            'slug' => 'cotizacion.eliminar',
            'description' => 'Eliminar cotizaciones'
        ]);

        Permission::create([
            'name' => 'Permiso de mostrar cotizacion',
            'slug' => 'cotizacion.mostrar',
            'description' => 'Mostrar una cotizacion'
        ]);

        Permission::create([
            'name' => 'Permiso de mostrar la cotizacion de un eveto',
            'slug' => 'evento.mostrar',
            'description' => 'Mostrar una cotizacion de evento'
        ]);

        Permission::create([
            'name' => 'Permiso de crear cotización',
            'slug' => 'cotizacion.crear',
            'description' => 'Crear una cotizacion'
        ]);

        Permission::create([
            'name' => 'Permiso de mostrar una promocion',
            'slug' => 'promocion.mostrar',
            'description' => 'Mostrar una promocion'
        ]);

        //COTIZACION EVENTO
        Permission::create([
            'name' => 'Permiso de navegar en cotizacion de evento',
            'slug' => 'evento.index',
            'description' => 'Navegar en cotizacion de evento'
        ]);

        Permission::create([
            'name' => 'Permiso de guardar un evento',
            'slug' => 'evento.almacenar',
            'description' => 'Guardar un evento'
        ]);

        Permission::create([
            'name' => 'Permiso de crear un evento',
            'slug' => 'evento.principal',
            'description' => 'Crear un evento'
        ]);

        //RESERVAS
        Permission::create([
            'name' => 'Permiso de navegar en reservas',
            'slug' => 'reservas.index',
            'description' => 'Navegar en reservas'
        ]);

        Permission::create([
            'name' => 'Permiso de actualizar reservas',
            'slug' => 'reservas.actualizar',
            'description' => 'Actualizar en reservas'
        ]);

        Permission::create([
            'name' => 'Permiso de eliminar reservas',
            'slug' => 'reservas.eliminar',
            'description' => 'Eliminar en reservas'
        ]);

        Permission::create([
            'name' => 'Permiso de mostrar reservas',
            'slug' => 'reservas.mostrar',
            'description' => 'Mostrar en reservas'
        ]);

        Permission::create([
            'name' => 'Permiso de mostrar categoria reservas',
            'slug' => 'reserva.categoria.mostrar',
            'description' => 'Mostrar categoria de reserva'
        ]);

        Permission::create([
            'name' => 'Permiso de crear una reserva',
            'slug' => 'reserva.guardar',
            'description' => 'Crear una reserva'
        ]);

        Permission::create([
            'name' => 'Permiso de guardar una reserva',
            'slug' => 'reserva.almacenar',
            'description' => 'Guardar una reserva'
        ]);

        //PROMOCIONES
        Permission::create([
            'name' => 'Permiso de ver promocion',
            'slug' => 'promocion.ver',
            'description' => 'Ver una promocion'
        ]);

        Permission::create([
            'name' => 'Permiso de ingresar promocion',
            'slug' => 'promocion.ingresar',
            'description' => 'Ingresar una promocion'
        ]);

        Permission::create([
            'name' => 'Permiso de guardar promocion',
            'slug' => 'promocion.store',
            'description' => 'Guardar una promocion'
        ]);

        Permission::create([
            'name' => 'Permiso de actualizar promocion',
            'slug' => 'promocion.actualizar',
            'description' => 'Actualizar una promocion'
        ]);

        Permission::create([
            'name' => 'Permiso de actualizar promocion',
            'slug' => 'promocion.update',
            'description' => 'Actualizar una promocion'
        ]);

        //SALIDAS
        Permission::create([
            'name' => 'Permiso de navegar por salidas',
            'slug' => 'salidas.indexVenta',
            'description' => 'Navegar por salidas'
        ]);

        Permission::create([
            'name' => 'Permiso de ver las salidas',
            'slug' => 'salidas.verSalidas',
            'description' => 'Ver las salidas'
        ]);

        Permission::create([
            'name' => 'Permiso de verificar una venta',
            'slug' => 'salidas.verificarVenta',
            'description' => 'Verificar una venta'
        ]);

        Permission::create([
            'name' => 'Permiso de almacenar una venta',
            'slug' => 'salidas.storeVenta',
            'description' => 'Almacenar una venta'
        ]);

        Permission::create([
            'name' => 'Permiso de almacenar entidad de una venta',
            'slug' => 'entidad.storeVenta',
            'description' => 'Almacenar una entidad de una venta'
        ]);

        Permission::create([
            'name' => 'Permiso de verificar una salida',
            'slug' => 'salidas.verificarSalida',
            'description' => 'Verificar una salida'
        ]);

        Permission::create([
            'name' => 'Permiso de guardar una salida',
            'slug' => 'salidas.store',
            'description' => 'Guardar una salida',
        ]);

        Permission::create([
            'name' => 'Permiso de ver una salida',
            'slug' => 'salidas.ver',
            'description' => 'Ver una salida'
        ]);

        //MAQUINAS
        Permission::create([
            'name' => 'Permiso de navegar por el listado de maquinas',
            'slug' => 'maquinas.index',
            'description' => 'Navegar por el listado de maquinas'
        ]);

        Permission::create([
            'name' => 'Permiso de crear una maquina',
            'slug' => 'maquinas.create',
            'description' => 'Crear una maquina'
        ]);

        Permission::create([
            'name' => 'Permiso de guardar una maquina',
            'slug' => 'maquinas.store',
            'description' => 'Guardar una maquina'
        ]);

        Permission::create([
            'name' => 'Permiso de mostrar una maquina',
            'slug' => 'maquinas.mostrar',
            'description' => 'Mostrar una maquinas'
        ]);

        Permission::create([
            'name' => 'Permiso de editar una maquina',
            'slug' => 'maquinas.edit',
            'description' => 'Editar una maquinas'
        ]);

        Permission::create([
            'name' => 'Permiso de actualizar una maquina',
            'slug' => 'maquinas.update',
            'description' => 'Actualizar una maquinas'
        ]);
    }
}
