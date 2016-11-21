<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
   public $timestamps=false;
   protected  $table="tipos";
   protected $fillable=['id','numero_c','descripcion'];

   
}
