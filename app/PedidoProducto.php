<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PedidoProducto extends Model
{
    protected $table = 'pedido_producto';

    public function detalles(){
        return $this->hasMany('App\Detalle');
    }
}
