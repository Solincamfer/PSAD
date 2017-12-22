<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Perfil extends Model
{
    public $timestamps=false;
    protected $table="perfiles";

    protected $fillable=['id','descripcion','status'];

    public function usuarios()
    {
      return $this->hasMany('App\Usuario');
    }

    public function modulos()
    {
      return $this->belongsToMany('App\Modulo');
    }


    public function submodulos()
    {
      return $this->belongsToMany('App\Submodulo');
    }

    public function acciones()
    {
      return $this->belongsToMany('App\Accion');
    }
}

