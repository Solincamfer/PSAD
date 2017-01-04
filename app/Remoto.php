<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Remoto extends Model
{
    public $timestamps=false;
    protected $table="remotos";
    protected $fillable=['id','plan_id','etiqueta','valor','precio'];


 public function plan()
    {
    	return $this->belongsTo('App\Plan');
    }

}
