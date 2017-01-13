<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auxiliar extends Model
{
    public $timestamps=false;
    protected $table="auxiliares";
    protected $fillable=['id','ultimo'];
}
