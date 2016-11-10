<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Usuario extends Model
{
    protected $table="usuarios";
    protected $fillable=['id','n_usuario','clave','perfil_id'];

    public function perfil()
    {
    	return $this->belongsTo('App\Perfil');
    }

    public function empleado()
    {
    	return $this->hasOne('App\Empleado');
    }
}
