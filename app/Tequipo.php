<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tequipo extends Model
{
   
	public $timestamps=false;
	protected $table="tequipos";
    protected $fillable=['id','descripcion'];

 public function Emarcas()
    {
    	return $this->belongsToMany('App\Emarca');
    }

 public function Ecomponentes()
 {
 	return $this->belongsToMany('App\Ecomponente');
 }

}
