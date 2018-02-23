<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModeloComponente extends Model
{
    public $timestamps=false;
	protected $table="modelocomponente"; 
	protected $fillable=['id','modelo_id','componente_id'];
}
