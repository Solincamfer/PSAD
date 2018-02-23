<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePiezas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('piezas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descripcion');
            $table->string('serial');
            $table->string('marca');
            $table->string('modelo');
            $table->unsignedInteger('status');
            $table->unsignedInteger('componente_id');
            $table->foreign('componente_id')->references('id')->on('componentes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('piezas');
    }
}
