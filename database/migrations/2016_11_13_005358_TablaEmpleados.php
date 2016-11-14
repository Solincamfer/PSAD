<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaEmpleados extends Migration
{
    public $timestamps=false;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',100);
            $table->string('apellido',100);
            $table->integer('usuario_id')->unsigned();
            $table->integer('cargo_id')->unsigned();
            $table->foreign('usuario_id')->references('id')->on('usuarios');
            $table->foreign('cargo_id')->references('id')->on('cargos');


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
