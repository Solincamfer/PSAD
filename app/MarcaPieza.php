<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MarcaPieza extends Model
{
    public $timestamps=false;
	protected $table="marcapieza"; 
	protected $fillable=['id','marca_id','pieza_id'];
}
