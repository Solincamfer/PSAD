<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModeloTipoEquipo extends Model
{
  public $timestamps=false;
  protected $table="modelo_tipoequipo";
  protected $fillable=['id','modelo_id','tipoequipo_id'];
}