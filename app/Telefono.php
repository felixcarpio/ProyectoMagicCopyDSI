<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Telefono extends Model
{
    protected $table = 'telefonos';

    public function contacto()
    {
            return $this->belongsTo('App\Contacto')->withPivot('numero')->withTimeStamps();
    }   
}
