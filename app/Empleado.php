<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
   public $timestamps=false;
   protected $table="empleados";
   protected $fillable=['id','nombre','nombre_','apellido','apellido_','fechaN','cedula_id','rif_id','departamento_id','direccion_id','contacto_id','usuario_id','cargo_id'];


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
