<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    public $timestamps=false;
    protected $table="personas";
    protected $fillable=['id','primerNombre','primerApellido','cargo','encargado','status','cedula_id','correo_id','cliente_id'];

    public function cliente()
    {
        return $this->belongsTo('App\Cliente');
    }

      public function categorias()
    {
        return $this->belongsToMany('App\Categoria');
    }

    public function sucursales()
    {
        return $this->belongsToMany('App\Sucursal');
    }



}
