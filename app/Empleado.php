<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
   public $timestamps=false;
   protected $table="empleados";
   protected $fillable=['id','primerNombre','segundoNombre','primerApellido','segundoApellido','fechaNaciemiento','status','cedula_id','rif_id','correo_id','direccion_id'];

   public function correo()
   {
    return $this->hasOne('App\Correo');
   }

   public function telefonos()
   {
    return $this->belongsToMany('App\Telefono');
   }

   public function cedula()
   {
    return $this->hasOne('App\Cedula');
   }

  public function rif()
   {
    return $this->hasOne('App\Rif');
   }
  

   public function direccion()
   {
    return $this->hasOne('App\Direccion');
   }

    public function departamento()
   {
    return $this->hasOne('App\Departamento');
   }

    public function area()
   {
    return $this->hasOne('App\Area');
   }


    public function cargo()
   {
    return $this->hasOne('App\Cargo');
   }

    public function usuarios()
   {
    return $this->belongsToMany('App\Usuario');
   }








}
