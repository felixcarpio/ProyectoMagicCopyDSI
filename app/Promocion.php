<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Promocion extends Model
{
  protected $table = 'promociones';

  public function productos()
  {
    return $this->belongsToMany('App\Producto', 'producto_promocion')->withPivot('cantidad', 'precio_unitario')->withTimeStamps();
  }

  public function setFechaInicioAttribute($input)
  {
    $this->attributes['fecha_inicio'] =
      Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
  }

  public function setFechaFinAttribute($input)
  {
    $this->attributes['fecha_fin'] =
      Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
  }

  public function getFechaInicioAttribute($value)
  {
    return Carbon::parse($value)->format('d/m/Y');
  }

  public function getFechaFinAttribute($value)
  {
    return Carbon::parse($value)->format('d/m/Y');
  }
}
