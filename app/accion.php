<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accion extends Model
{
    public $timestamps=false;
    protected $table="acciones";
    protected $fillable=['id','status_ac','descripcion','url','clase_css','submodulo_id'];

    public function submodulo()
    {
      return $this->belongsTo('App\Submodulo');
    }

    public function perfiles()
    {
      return $this->belongsToMany('App\Perfil');
    }
    
}
