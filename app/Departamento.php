<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    public $timestamps=false;
    protected $table="departamentos";
    protected $fillable=['id','status','descripcion','director_id'];

    public function direcciones(){
    	return $this->belongsto('App\Director');
    }
    public function areas()
    {
    	return $this->hasMany('App\Area');
    }
}
