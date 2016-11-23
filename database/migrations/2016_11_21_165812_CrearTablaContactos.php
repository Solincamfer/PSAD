<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaContactos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public $timestamps=false;
    public function up()
    {
        Schema::create('contactos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tipo_id')->unsigned();
            $table->integer('tipo__id')->unsigned();
            $table->string('telefono_m',100);
            $table->string('telefono_f',100);
            $table->string('correo',100);
            $table->foreign('tipo_id')->references('id')->on('tipos')->onDelate('cascade');
            $table->foreign('tipo__id')->references('id')->on('tipos')->onDelate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contactos');
    }
}
