<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Evento extends Model
{
  protected $table = 'eventos';
    public function clasificacion(){
        return $this->belongsTo(Clasificacion::class);
      }
      public function setFechaEventoAttribute($input)
      {
        $this->attributes['fecha_evento'] =
          Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
      }

      public function getFechaEventoAttribute($value)
      {
        return Carbon::parse($value)->format('d/m/Y');
      }


}
