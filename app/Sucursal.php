<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    public $timestamps=false;
    protected $table="sucursales";
     protected $fillable=['id','razonSocial','nombreComercial','status','rif_id','direccionFiscal_id','direccionComercial_id','correo_id','tipoContribuyente_id','categoria_id'];




    public function categoria()
    {
        return $this->belongsTo('App\Categoria');
    }

    public function personas()
    {
        return $this->belongsToMany('App\Persona');
    }

    public function planes()
    {
        return $this->belongsToMany('App\Plan');
    }

     public function equipos()
    {
        return $this->hasMany('App\Equipo');
    }
}
