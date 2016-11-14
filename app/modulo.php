<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    public $timestamps=false;
    protected $table="modulos";
    protected $fillable=['id','status_m','descripcion','url'];

    public function submodulos()
    {
    	return $this->hasMany('App\Submodulo');
    }

    public function perfiles()
    {
    	return $this->belongsToMany('App\Perfil');
    }

}

	

