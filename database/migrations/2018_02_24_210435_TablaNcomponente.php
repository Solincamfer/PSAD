<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaNcomponente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ncomponentes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descripcion',100);
            $table->integer('tipoequipo_id')->unsigned();

            $table->foreign('tipoequipo_id')->references('id')->on('tipoequipos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ncomponentes');
    }
}
