<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clasificacion extends Model
{
  protected $table = 'clasificaciones';
    public function eventos(){
        return $this->hasMany('App/Evento');
      }
}
