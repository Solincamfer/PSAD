<?php

namespace App;

use Illuminate\Database\Eloquent\Model;



class Epieza extends Model
{
    public $timestamps=false;
	protected $table="epiezas";
	protected $fillable=['id','descripcion'];


	public function Ecomponentes()
 	{
 		return $this->belongsToMany('App\Epieza');
 	}
}
