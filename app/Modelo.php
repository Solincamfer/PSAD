<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
     public $timestamps=false;
  	 protected $table="modelos"; 
  	 protected $fillable=['id','descripcion'];

  	public function tipoequipos()
    {
        return $this->belongsToMany('App\Tipoequipo');
    }

    public function marcas()
    {
        return $this->belongsToMany('App\Marca');
    }

    public function ncomponentes()
    {
        return $this->belongsToMany('App\Ncomponente');
    }

    public function npiezas()
    {
        return $this->belongsToMany('App\Npieza');
    }


}
