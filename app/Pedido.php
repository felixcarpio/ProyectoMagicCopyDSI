<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Pedido extends Model
{

  protected $table = 'pedidos';

    public function productos(){
      return $this->belongsToMany('App\Producto')->withPivot('costo_unitario','fecha_recibido','cantidad_ordenada')->withTimeStamps();
    }

    public function setFechaSolicitudAttribute($input)
  {
    $this->attributes['fecha_solicitud'] =
      Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
  }

    public function setFechaRecibidoAttribute($input)
  {
    $this->attributes['fecha_recibido'] =
      Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
  }

}
