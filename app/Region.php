<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
   public $timestamps=false;

   protected $table='regiones';
   protected $fillable=['id','descripcion','pais_id'];

   public function pais()
   {
   	 return $this->belongsTo('App\Pais');
   }

   public function estados()
   {
   	 return $this->hasMany('App\Estado');
   }

}
