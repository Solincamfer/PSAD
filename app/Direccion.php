<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    public $timestamps=false;
    protected $table="direcciones";
    protected $fillable=['id','descripcion','codigoPostal','municipio_id','pais_id','region_id','estado_id'];
    

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

   public function empleado()
   {
    return $this->belongsTo('App\Empleado');
   }

}
