<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class accion extends Model
{
    protected $table='acciones';
    protected $fillable=['id','status_sm','descripcion','id_modulo'];//
}
