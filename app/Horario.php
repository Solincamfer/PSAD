<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    public $timestamps=false;
    protected $table="horarios";
    protected $fillable=['id','plan_id','horaI','horaF','diaI','diaF','precio'];



    public function plan()
    {
    	return $this->belongsTo('App\Plan');
    }
}
