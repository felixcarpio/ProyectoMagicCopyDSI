<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = ['nombre','apellido','correo','dui','nombre_empresa','direccion'];

    public function telefonos(){
        return $this->hasMany('App\Telefono');
    }

    public function maquinas(){
        return $this->hasMany('App\Maquina','cliente_maquina','cliente_id','maquina_id');
    }
}
