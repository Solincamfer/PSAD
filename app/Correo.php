<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Correo extends Model
{
   public $timestamps=false;
   protected $table="correos";
   protected $fillable=['id','correo'];


   public function empleado()
   {
    return $this->belongsTo('App\Empleado');
   }
}
