<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    public $timestamps=false;
    protected $table="categorias";
    protected $fillable=['id','nombre','status_c','cliente_id'];

    public function cliente()
    {
    	return $this->belongsTo('App\Cliente');
    }

    public function personas()
    {
    	return $this->belongsToMany('App\Persona');
    }

    public function sucursales()
    {


        return $this->hasMany('App\Sucursal');
    }
}
