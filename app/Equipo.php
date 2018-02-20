<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
     public $timestamps=false;
  	 protected $table="equipos"; 
  	 protected $fillable=['id','descripcion','tipoequipo','marca','modelo','serial','status'];
}
