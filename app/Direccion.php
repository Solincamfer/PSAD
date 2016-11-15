<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    $table="direcciones";
    $fillable=['id','descripcion','municipio_id'];
}
