<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EmpledosTabla extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public $timestamps=false;
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',100);
            $table->string('nombre_',100);
            $table->string('apellido',100);
            $table->string('apellido_',100);
            $table->date('fechaN');

            $table->integer('cedula_id')->unsigned();
            $table->integer('rif_id')->unsigned();
            $table->integer('departamento_id')->unsigned();
            $table->integer('cargo_id')->unsigned();
            $table->integer('direccion_id')->unsigned();
            $table->integer('contacto_id')->unsigned();
            $table->integer('usuario_id')->unsigned();

            
            $table->foreign('cedula_id')->references('id')->on('cedulas');
            $table->foreign('rif_id')->references('id')->on('rifs');
            $table->foreign('departamento_id')->references('id')->on('departamentos');
            $table->foreign('cargo_id')->references('id')->on('cargos');
            $table->foreign('direccion_id')->references('id')->on('direcciones');
            $table->foreign('contacto_id')->references('id')->on('contactos');
            $table->foreign('usuario_id')->references('id')->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empleados');
    }
}
