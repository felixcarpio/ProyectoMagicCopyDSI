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

    public function contactos()
    {
        return $this->belongsToMany('App\Contacto','contacto_maquina','maquina_id','contacto_id');
    }
}
