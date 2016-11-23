<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaPersonas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public $timestamps=false;
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('p_nombre',100);
            $table->string('s_nombre',100);
            $table->string('p_apellido',100);
            $table->string('s_apellido',100);
            $table->string('cargo',200);
            $table->integer('encargado')->default(0);

            $table->integer('cedula_id')->unsigned();
            $table->integer('contacto_id')->unsigned();
            $table->integer('cliente_id')->unsigned();


            $table->foreign('cedula_id')->references('id')->on('cedulas')->onDelate('cascade');
            $table->foreign('contacto_id')->references('id')->on('contactos')->onDelate('cascade');
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelate('cascade');
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
