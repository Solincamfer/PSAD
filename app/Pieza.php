<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pieza extends Model
{
    public $timestamps=false;
    protected $table='piezas';
    protected $fillable=['id','descripcion','serial','marca','modelo','status','componente_id'];

}
