<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Usuario extends Model
{
    protected $table="usuarios";
    protected $fillable=['id','n_usuario','clave','status','perfil_id'];
    public $timestamps=false;
    
    public function perfil()
    {
    	return $this->belongsTo('App\Perfil');
    }

    public function empleados()
    {
        return $this->belongsToMany('App\Empleado');
    }

   
}
