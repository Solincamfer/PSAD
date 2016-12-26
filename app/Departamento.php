<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    public $timestamps=false;
    protected $table="departamentos";
    protected $fillable=['id','status','descripcion',];

    public function cargos()
    {
    	return $this->hasMany('App\Cargo');
    }
}
