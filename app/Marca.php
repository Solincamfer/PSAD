<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
	public $timestamps=false;
    protected $table="marcas";
    protected $fillable=['id','nombre','tipo'];


    public function equipo()
    {
    	return $this->belongsTo('App\Equipo');
    }
}
