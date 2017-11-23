<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    public $timestamps=false;
    protected $table="modelos";
    protected $fillable=['id','descripcion','tipo']


    public function equipo()
    {
    	return $this->belongsTo('App\Equipo');
    }
}
