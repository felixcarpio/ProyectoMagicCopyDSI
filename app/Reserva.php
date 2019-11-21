<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    public function estadoreserva(){
        return $this->belongsTo(EstadoReserva::class);
      }
      public function productos(){
      return $this->belongsToMany('App\Producto')->withPivot('cantidad_ordenada')->withTimeStamps();
    }
}
