<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    public $timestamps=false;
    protected $table="equipos";
    protected $fillable=['id','nombre','serial','status'];



    public function marcas()
    {
    	return $this->hasMany('App\Marca');
    }

    public function modelos()
    {
    	return $this->hasMany('App\Modelo');
    }

    public function tipoequipos()
    {
    	return $this->hasMany('App\Modelo');
    }
}
