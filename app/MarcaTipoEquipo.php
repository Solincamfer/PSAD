<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MarcaTipoEquipo extends Model
{
  public $timestamps=false;
  protected $table="marca_tipoequipo";
  protected $fillable=['id','marca_id','tipoequipo_id'];
}
