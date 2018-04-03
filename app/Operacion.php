<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operacion extends Model
{
    public $timestamps=false;
    protected $table="operaciones";

    protected $fillable=['id','descripcion'];
}
