<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
   public $timestamps=false;
   protected  $table="clientes";
   protected $fillable=['id','razonSocial','nombreComercial','status','rif_id','direccionFiscal_id','direccionComercial_id','correo_id','tipoContribuyente_id'];


 
   
}
