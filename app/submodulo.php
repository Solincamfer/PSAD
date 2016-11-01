<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class submodulo extends Model
{
   protected $table="sudmodulos"; //
   protected $fillable=['id','status_sm','descripcion','id_modulo'];
}
