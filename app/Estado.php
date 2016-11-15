<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    $table="estados";
    $fillable=['id','descripcion','region_id'];
}
