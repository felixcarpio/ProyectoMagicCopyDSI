<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
  protected $table = 'productos';

    public function pedidos(){
      return $this->belongsToMany('App\Pedido')->withPivot('costo_unitario','fecha_recibido','cantidad_ordenada')->withTimeStamps();
    }
  
    public function marca(){
      return $this->belongsTo(Marca::class);
    }
  
    public function proveedores(){
      return $this->belongsToMany(Proveedor::class);
    }

    public function promociones(){
      return $this->belongsToMany(Promocion::class);
    }
}
