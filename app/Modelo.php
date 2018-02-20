<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
     public $timestamps=false;
  	 protected $table="modelos"; 
  	 protected $fillable=['id','descripcion','marca_id'];





  	 public function marca()
  	 {
  	 	 return $this->belongsTo('App\Marca');
  	 }
}
