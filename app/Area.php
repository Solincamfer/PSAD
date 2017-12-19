<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    public $timestamps=false;
    protected $fillable=['id','descripcion','status','departamento_id'];
    protected $table="areas";

    public function departamentos(){
    	return $this->belongsto('App\Departamento');
    }
    public function cargos(){
    	return $this->hasMany('App\Cargo');
    }
}
