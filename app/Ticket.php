<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Ticket extends Model
{
    public $table = "tickets";

    public function setFechaInicioAttribute($input)
    {
        $this->attributes['fecha_inicio'] = 
        Carbon::createFromFormat(config('app.date_format'),$input)->format('Y-m-d');
    }

    public function setFechaFinAttribute($input)
    {
        $this->attributes['fecha_fin'] = 
        Carbon::createFromFormat(config('app.date_format'),$input)->format('Y-m-d');
    }

    public function maquina()
    {
        return $this->belongsTo('App\Maquina');
    }

    public function piezas()
    {
        return $this->hasMany('App\Pieza');
    }
}
