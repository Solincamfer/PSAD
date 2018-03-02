<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aplicacion extends Model
{
    
    public $timestamps=false;
    protected $table='aplicaciones';
    protected $fillable=['id','descripcion','licencia','version','status','equipo_id'];

    public function equipo()
    {
        return $this->belongsTo('App\Equipo');
    }
}
