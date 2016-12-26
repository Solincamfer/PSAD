<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    public $timestamps=false;
    protected $table="cargos";
    protected $fillable=['id','status','departamento_id','descripcion'];



    public function departamento()
    {
    	return $this->belongsTo('App\Departamento');
    }

    public function empleados()
    {
    	return $this->hasMany('App\Empleado');
    }
}
