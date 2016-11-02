<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class submodulo extends Model
{
   protected $table="submodulos"; //
   protected $fillable=['id','status_sm','descripcion','id_modulo'];


   public function perfiles()
  	 {

   		return $this->belongsToMany('App\perfil');

   	}

   	 public function modulo()
   {
   	return $this->hasMany('App\modulo');
   }

   public function acciones()
   {

   		return $this->hasMany('App\accion');
   }


}
