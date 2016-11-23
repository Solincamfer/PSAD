<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cedula extends Model
{
    public $timestamps=false;
    protected $table="cedulas";
    protected $fillable=['id','numero','tipo_id','persona_id'];

    public function persona()
    {
    	return $this->belongsTo('App\Persona');
    	
    }
}
