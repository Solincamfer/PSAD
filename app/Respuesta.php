<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
   public $timestamps=false;
   protected $table="respuestas"; 
   protected $fillable=['id','plan_id','maximo','precio'];

   

    public function plan()
    {
    	return $this->belongsTo('App\Plan');
    }
}
