<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    public $timestamps=false;
    protected $table="sucursales";
    protected $fillable=['id','razon_s','nombre_c','rif_id','tipo_id','direccion_id','direccion__id','contacto_id','cliente_id','categoria_id'];


public function categoria()
{
	

	return $this->belongsTo('App\Categoria');
}


}
