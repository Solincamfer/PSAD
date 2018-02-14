<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    public $timestamps=false;
    protected $table="sucursales";
     protected $fillable=['id','razonSocial','nombreComercial','status','rif_id','direccionFiscal_id','direccionComercial_id','correo_id','tipoContribuyente_id','categoria_id'];



}
