<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
  protected $table = 'proveedores';
  
  public function productos(){
    return $this->belongsToMany('App\Producto', 'producto_proveedor')->withPivot('producto_id');
  }
}
