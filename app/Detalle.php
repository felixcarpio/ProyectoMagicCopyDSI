<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalle extends Model
{
    public function pedidosProductos(){
        return $this->belongsTo('App\PedidoProducto');
    }

    public function salidas(){
        return $this->belongsTo('App\Salida');
    }
}
