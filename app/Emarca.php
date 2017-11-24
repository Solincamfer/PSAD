<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Emarca extends Model
{
   public $timestamps=false;
	protected $table="emarcas";
    protected $fillable=['id','descripcion'];


    public function Tequipos()
    {
    	return $this->belongsToMany('App\Tequipo');
    }
}
