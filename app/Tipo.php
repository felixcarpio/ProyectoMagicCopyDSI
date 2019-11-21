<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    public function salidas(){
        return $this->hasMany('App/Salida');
    }
}
