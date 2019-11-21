<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstadoReserva extends Model
{
  protected $table = 'estado_reserva';
    public function reservas(){
        return $this->hasMany('App/Reserva');
      }
}
