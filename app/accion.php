<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class accion extends Model
{
    protected $table='acciones';
    protected $fillable=['id','status_sm','descripcion','id_modulo'];//


    public function perfiles()
  	 {

   		return $this->belongsToMany('App\perfil');

   	}

   	public function submodulo()
  	 {

   		return $this->belongsTo('App\submodulo');

   	}
}
