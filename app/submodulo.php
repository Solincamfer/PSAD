<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submodulo extends Model
{
    protected $table="submodulos";
    protected $fillable=['id','status_sm','descripcion','url','ruta','modulo_id','padre'];
    public $timestamps=false;

    public function modulo()
    {
      return $this->belongsTo('App\Modulo');
    }

    public  function acciones()
    {
      return $this->hasMany('App\Accion');
    }

    public function perfiles()
    {
      return $this->belongsToMany('App\Perfil');
    }
    
}
