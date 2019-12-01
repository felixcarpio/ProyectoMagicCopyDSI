<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoriaProducto extends Model
{
    protected $table = 'categorias_productos';
    public function categoriaProductos(){
        return $this->hasMany('App/Producto');
      }
}
