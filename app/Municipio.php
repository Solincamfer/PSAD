<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    $table="municipios";
    $fillable=['id','descripcion','estado_id'];
}
