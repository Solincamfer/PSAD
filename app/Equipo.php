<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
     public $timestamps=false;
  	 protected $table="equipos"; 
  	 protected $fillable=['id','descripcion','tipoequipo','marca','modelo','serial','status'];


  	public function sucursal()
    {
        return $this->belongsTo('App\Sucursal');
    }


    public function componentes()
    {
        return $this->hasMany('App\Componente');
    }


    public function aplicaciones()
    {
        return $this->hasMany('App\Aplicacion');
    }


}
