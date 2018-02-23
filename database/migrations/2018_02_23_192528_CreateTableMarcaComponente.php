<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMarcaComponente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marcaComponente', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('marca_id');
            $table->unsignedInteger('componente_id');
            $table->foreign('marca_id')->references('id')->on('marcas');
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
        Schema::dropIfExists('marcaComponente');
    }
}
