<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comprador extends Model
{
    protected $table = 'compradores';

    public function salidas(){
        return $this->belongsToMany('App\Salida')->withTimeStamps();
    }
}
