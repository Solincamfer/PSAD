<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    public $timestamps=false;
    protected $table="paises";
    protected $fillable=['id','descripcion'];

    public function regiones()
   	{
   	 return $this->hasMany('App\Region');
   	}

}
