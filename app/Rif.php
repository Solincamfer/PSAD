<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rif extends Model
{
   public $timestamps=false;
   protected  $table="rifs";
   protected $fillable=['id','numero','tipo_id'];
}
