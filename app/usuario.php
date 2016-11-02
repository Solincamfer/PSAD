<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class usuario extends Model
{
    protected $table="usuarios";
    protected $fillable=['id','usuario_','id_perfil'];//



    public function perfil()
    {

    	return $this->belongsTo('App\perfil');
    }
}
