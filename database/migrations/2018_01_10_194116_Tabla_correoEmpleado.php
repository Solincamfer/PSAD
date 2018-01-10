<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaCorreoEmpleado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('correo_empleado', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('correo_id')->unsigned();
            $table->integer('empleado_id')->unsigned();

            $table->foreign('correo_id')->references('id')->on('correos');
            $table->foreign('empleado_id')->references('id')->on('empleados');



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('correo_empleado');
    }
}
