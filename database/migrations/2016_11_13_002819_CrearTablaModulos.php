<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaModulos extends Migration
{
    public $timestamps=false;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modulos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('status_m')->default(0);
            $table->string('descripcion',100);
            $table->string('url',100);
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modulos');
    }
}
