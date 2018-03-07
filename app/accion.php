<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accion extends Model
{
    public $timestamps=false;
    protected $table="acciones";
    protected $fillable=
                        [
                            'id',
                            'status_ac',
                            'descripcion',
                            'url',
                            'clase_css',
                            'identificador',
                            'clase_cont',
                            'clase_css',
                            'clase_elem',
                            'ventana',
                            'orden',
                            'vista',
                            'submodulo_id',
                            'tabla',
                            'accion_id'
                           ];

    public function submodulo()
    {
      return $this->belongsTo('App\Submodulo');
    }

    public function perfiles()
    {
      return $this->belongsToMany('App\Perfil');
    }
    
}
