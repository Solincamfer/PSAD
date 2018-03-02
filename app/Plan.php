<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    public $timestamps=false;
    protected $table="planes";
    protected $fillable=['id','nombreP','descuento','status'];


public function horarios()
{
	
	return $this->hasMany('App\Horario');
}

public function telefonicos()
{
	
	return $this->hasMany('App\Telefonico');
}


public function respuestas()
{
	
	return $this->hasMany('App\Respuesta');
}



public function presenciales()
{
	
	return $this->hasMany('App\Presencial');
}



public function remotos()
{
	
	return $this->hasMany('App\Remoto');
}

 public function sucursales()
    {
        return $this->belongsToMany('App\Sucursal');
    }



}
