<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipoequipo extends Model
{
    public $timestamps=false;
    protected $table="tipoequipos";
    protected $fillable=['id','descripcion'];
}
