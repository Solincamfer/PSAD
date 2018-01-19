<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Telefono extends Model
{
   public $timestamps=false;
   protected $table="telefonos";
   protected $fillable=['id','codigo','telefono','tipo'];

   public function empleados()
   {
    return $this->belongsToMany('App\Empleado');
   }
   
}
