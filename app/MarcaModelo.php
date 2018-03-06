<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MarcaModelo extends Model
{
  public $timestamps=false;
  protected $table="marca_modelo";
  protected $fillable=['id','marca_id','modelo_id'];
}