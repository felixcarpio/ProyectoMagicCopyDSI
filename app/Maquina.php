<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maquina extends Model
{
    public $table = "maquinas";

    public function categoria()
    {
        return $this->belongsTo('App\Categoria');
    }

    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }

    public function clientes()
    {
        return $this->belongsToMany('App\Cliente','cliente_maquina','maquina_id','cliente_id');
    }
}
