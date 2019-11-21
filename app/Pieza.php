<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pieza extends Model
{
    public function ticket()
    {
        return $this->belongsTo('App\Ticket');
    }
}
