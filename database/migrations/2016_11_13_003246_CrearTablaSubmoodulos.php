<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaSubmoodulos extends Migration
{
    public $timestamps=false;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submodulos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('status_sm')->default(0);
            $table->string('descripcion',100);
            $table->string('url',100);
            $table->string('ruta',100);
            $table->integer('modulo_id')->unsigned();
            $table->integer('padre')->default(0);
            $table->foreign('modulo_id')->references('id')->on('modulos')->onDelate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('submodulos');
    }
}
