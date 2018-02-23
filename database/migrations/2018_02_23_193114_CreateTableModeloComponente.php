<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableModeloComponente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modeloComponente', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('modelo_id');
            $table->unsignedInteger('componente_id');
            $table->foreign('modelo_id')->references('id')->on('modelos');
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
        Schema::dropIfExists('modeloComponente');
    }
}
