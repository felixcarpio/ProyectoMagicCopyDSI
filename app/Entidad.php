<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entidad extends Model
{
    protected $table = 'entidades';

    public function salidas(){
        return $this->belongsToMany('App\Salida')->withTimeStamps();
    }
}
 