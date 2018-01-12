<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaDireccionEmpleado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direccion_empleado', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('direccion_id')->unsigned();
            $table->integer('empleado_id')->unsigned();

            $table->foreign('direccion_id')->references('id')->on('direcciones');
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
        Schema::dropIfExists('direccion_empleado');
    }
}
