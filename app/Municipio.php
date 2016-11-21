<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    public $timestamps=false;
    protected $table="municipios";
    protected $fillable=['id','descripcion','estado_id'];

    public function estado()
    {
    	return $this->belongsTo('App\Estado');
    }

   public function direcciones()
   {
     return $this->hasMany('App\Direccion');
   }
}
