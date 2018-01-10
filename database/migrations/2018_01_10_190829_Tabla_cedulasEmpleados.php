<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaCedulasEmpleados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cedula_empleado', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cedula_id')->unsigned();
            $table->integer('empleado_id')->unsigned();

            $table->foreign('cedula_id')->references('id')->on('cedulas');
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
        Schema::dropIfExists('cedula_empleado');
    }
}
