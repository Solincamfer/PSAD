<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
   public $timestamps=false;
   protected $table="estados";
   protected $fillable=['id','descripcion','region_id'];

   public function region()
   {
   	 return $this->belongsTo('App\Region');
   }

   public function municipios()
   {
   	 return $this->hasMany('App\Municipio');
   }
   
}
