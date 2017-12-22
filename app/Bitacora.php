<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{
   
    protected $table="bitacoras";
    protected $fillable=['id','usuario','accion','created_at','updated_at','registro_id','ventana','detalles'];
}
