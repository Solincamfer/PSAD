<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MarcaComponente extends Model
{
    public $timestamps=false;
	protected $table="marcacomponente"; 
	protected $fillable=['id','marca_id','componente_id'];
}
