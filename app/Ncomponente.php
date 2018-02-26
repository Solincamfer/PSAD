<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ncomponente extends Model
{
    public $timestamps=false;
    protected $table="ncomponentes";

    protected $fillable=['id','descripcion','tipoequipo_id'];


     public function tipoequipo()
    {
        return $this->belongsTo('App\Tipoequipo');
    }

     public function marcas()
    {
        return $this->belongsToMany('App\Marca');
    }

     public function modelos()
    {
        return $this->belongsToMany('App\Modelo');
    }

     public function npiezas()
    {
        return $this->hasMany('App\Npieza');
    }
}
