<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
   public $timestamps=false;
   protected $table="empleados";
   protected $fillable=['id','nombre','apellido','usuario_id','cargo_id'];


  /* public function usuario()
    {

    	return $this->hasOne('App\Usuario');

    }

*/
    public function cargo()
    {
    	return $this->belongsTo('App\Cargo');
    }


}
