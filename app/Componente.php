<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Componente extends Model
{
   
	public $timestamps=false;
    protected $table='componentes';
    protected $fillable=['id','descripcion','serial','marca','modelo','status','equipo_id'];

    public function equipo()
    {
        return $this->belongsTo('App\Equipo');
    }


    public function piezas()
    {
        return $this->hasMany('App\Pieza');
    }

}
