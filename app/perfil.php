<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Perfil extends Model
{
    protected $table="perfiles";

    protected $fillable=['id','descripcion'];

    public function usuarios()
    {
      return $this->hasMany('App\Usuario');
    }

    public function modulos()
    {
      return $this->belongsToMany('App\Modulo')->withTimestamps();
    }


    public function submodulos()
    {
      return $this->belongsToMany('App\Submodulo')->withTimestamps();
    }

    public function acciones()
    {
      return $this->belongsToMany('App\Accion')->withTimestamps();
    }
}

