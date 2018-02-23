<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModeloPieza extends Model
{
    public $timestamps=false;
	protected $table="modelocomponente"; 
	protected $fillable=['id','modelo_id','pieza_id'];
}
