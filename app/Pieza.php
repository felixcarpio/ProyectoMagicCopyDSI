<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pieza extends Model
{
    protected $fillable=['nombre','precio_unitario',
    'precio_venta','cantidad','subtotal','ticket_id'];

    public function ticket()
    {
        return $this->belongsTo('App\Ticket');
    }
}
