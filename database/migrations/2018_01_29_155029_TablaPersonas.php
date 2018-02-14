<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaPersonas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('primerNombre',100);
            $table->string('primerapellido',100);
            $table->string('cargo',100);
            $table->integer('status')->default(1);
            $table->integer('cedula_id')->unsigned();
            $table->integer('correo_id')->unsigned();
            $table->integer('cliente_id')->unsigned();

            $table->foreign('cedula_id')->references('id')->on('cedulas');
            $table->foreign('correo_id')->references('id')->on('correos');
            $table->foreign('cliente_id')->references('id')->on('clientes');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personas');
    }
}
