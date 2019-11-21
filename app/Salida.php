<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Salida extends Model
{
    public function tipos(){
        return $this->belongsTo('App\Tipo');
    }

    public function compradores(){
        return $this->belongsToMany('App\Comprador')->withTimeStamps();
    }

    public function entidades(){
        return $this->belongsToMany('App\Entidad')->withTimeStamps();
    }

    public function detalles(){
        return $this->hasMany('App\Detalle');
    }

    public function setFechaEmisionAttribute($input)
  {
    $this->attributes['fecha_emision'] =
      Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
  }

  public function getFechaEmisionAttribute($value)
  {
    return Carbon::parse($value)->format('d/m/Y');
  }
} 
