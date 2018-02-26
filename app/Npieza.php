<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Npieza extends Model
{
    public $timestamps=false;
    protected $table="npiezas";

    protected $fillable=['id','descripcion','ncomponente_id'];

     public function ncomponente()
    {
        return $this->belongsTo('App\Ncomponente');
    }

    public function marcas()
    {
        return $this->belongsToMany('App\Marca');
    }

    public function modelos()
    {
        return $this->belongsToMany('App\Modelo');
    }
}
