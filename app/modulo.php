<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class modulo extends Model
{
   protected $table="modulos";
   protected $fillable=['id','status_m','descripcion'];//


   
   
   
   public function perfiles()
   {

   	return $this->belongsToMany('App\perfil');

   }

   public function submodulos()
   {
   	return $this->belongsTo('App\submodulo');
   }

	
}
