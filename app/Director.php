<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Director extends Model
{
    public $timestamps=false;
    protected $fillable=['id','descripcion','status'];
    protected $table="directores";

    public function departamentos(){
    	return $this->hasMany('App\Departamento');
    }
}
