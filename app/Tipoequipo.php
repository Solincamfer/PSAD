<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipoequipo extends Model
{
     public $timestamps=false;
  	 protected $table="tipoequipos"; 
  	 protected $fillable=['id','descripcion'];


  	public function marcas()
    {
        return $this->belongsToMany('App\Marca');
    }


    public function modelos()
    {
        return $this->belongsToMany('App\Modelo');
    }

     public function componentes()
    {
        return $this->hasMany('App\Ncomponente');
    }
}
