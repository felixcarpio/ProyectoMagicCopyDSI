<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    protected $fillable=['nombre','apellido','correo','dui','direccion','empresa_id'];
    
    public function telefonos()
    {
        return $this->hasMany('App\Telefono');
    }

    public function empresa(){
        return $this->belongsTo(Empresa::class);
      }

    public function maquinas()
    {
        return $this->hasMany('App\Maquina','contacto_maquina','contacto_id','maquina_id');
    }
}
