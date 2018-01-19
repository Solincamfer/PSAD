<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    public $timestamps=false;
    protected $table="cargos";
    protected $fillable=['id','status','descripcion','area_id'];



    public function area()
    {
    	return $this->belongsTo('App\Area');
    }

    public function empleados()
    {
    	return $this->hasMany('App\Empleado');
    }

    public function empleado()
   {
    return $this->belongsTo('App\Empleado');
   }
}
