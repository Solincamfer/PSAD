<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    $table='regiones';
    $fillable=['id','descripcion','pais_id'];
}
