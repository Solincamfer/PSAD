<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ecomponente extends Model
{
   public $timestamps=false;
   protected $table="ecomponentes";
   protected $fillable=['id','descripcion'];

 public function Tequipos()
 {
 	return $this->belongsToMany('App\Tequipo');
 }

public function Epiezas()
 {
 	return $this->belongsToMany('App\Epieza');
 }
 
}
