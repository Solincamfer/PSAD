<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaNpieza extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('npiezas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descripcion',100);
            $table->integer('ncomponente_id')->unsigned();

            $table->foreign('ncomponente_id')->references('id')->on('ncomponentes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('npieza');
    }
}
