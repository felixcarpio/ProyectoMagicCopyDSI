<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Telefono extends Model
{
    protected $table = 'telefonos';

    public function cliente()
    {
            return $this->belongsTo('App\Cliente')->withPivot('numero')->withTimeStamps();
    }   
}
