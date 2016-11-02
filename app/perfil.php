<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class perfil extends Model
{
   protected $table="perfiles";
   protected $fillable=['id','descripcion'];// //

  public function usuarios()
  {

  	return $this->hasMany('App\usaurio');
  }

   public function modulos()
   {
   	return $this->belongsToMany('App\modulo');
   }

   public function submodulos()
   {

   	return $this->belongsToMany('App\submodulo');
   }

   public function acciones()
   {
   	return $this->belongsToMany('App\sccion');

   }
}

