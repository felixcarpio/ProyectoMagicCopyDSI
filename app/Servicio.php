<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    public function tickets()
    {
        return $this->hasToMany('App\Ticket');
    }
}
