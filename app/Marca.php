<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
  public function productos(){
    return $this->hasMany('App/Producto');
  }
}
