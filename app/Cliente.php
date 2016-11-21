<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
   public $timestamps=false;
   protected  $table="clientes";
   protected $fillable=['id','razon_s','nombre_c','rif_id','tipo_id','direccion_id','direccion__id','contacto_id'];
}
