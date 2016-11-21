<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
   public $timestamps=false;
   protected  $table="contactos";
   protected $fillable=['id','tipo_id','tipo__id','telefono_m','telefono_f'];
}
