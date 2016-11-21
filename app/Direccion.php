<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    $table="direcciones";
    $fillable=['id','descripcion','municipio_id','pais_id','region_id','estado_id'];

    public function estado()
    {
    	return $this->belongsTo('App\Estado');
    }

    public function region()
    {
    	return $this->belongsTo('App\Region');
    }

    public function pais()
    {
    	return $this->belongsTo('App\Pais');
    }

    public function municipio()
    {
        return $this->belongsTo('App\Municipio');
    }

}
