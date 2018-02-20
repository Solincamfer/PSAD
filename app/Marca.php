<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
     public $timestamps=false;
  	 protected $table="marcas"; 
  	 protected $fillable=['id','descripcion'];


  	public function tipoequipos()
    {
        return $this->belongsToMany('App\Tipoequipo');
    }

    public function modelos()
    {
    	return $this->hasMany('App\Modelo');
    }
}
