<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    public $timestamps=false;
    protected $table="departamentos";
    protected $fillable=['id','status_d','nombre_d',];

    public function cargos()
    {
    	return $this->hasMany('App\Cargo');
    }
}
