<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModeloNcomponente extends Model
{
  public $timestamps=false;
  protected $table="modelo_ncomponente";
  protected $fillable=['id','modelo_id','ncomponente_id'];
}
