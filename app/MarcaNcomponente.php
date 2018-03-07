<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MarcaNcomponente extends Model
{
  public $timestamps=false;
  protected $table="marca_ncomponente";
  protected $fillable=['id','marca_id','ncomponente_id'];
}
