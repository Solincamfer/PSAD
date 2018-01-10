<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cedula extends Model
{
    public $timestamps=false;
    protected $table="cedulas";
    protected $fillable=['id','numero','rol','tipo_id'];

    

    
   public function empleado()
   {
    return $this->belongsTo('App\Empleado');
   }
}
