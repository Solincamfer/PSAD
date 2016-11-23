<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    public $timestamps=false;
    protected $table="personas";
    protected $fillable=['id','p_nombre','s_nombre','p_apellido','s_apellido','cargo','encargado','contacto_id','cliente_id'];


    public function cedula ()
    {
    	return $this->hasOne('App\Cedula');
    }


    public function contacto()

    {

    	return $this->hasOne('App\Contacto');
    }


    public function cliente()
    {

    	return $this->belongsTo('App\Cliente');
    }
}
