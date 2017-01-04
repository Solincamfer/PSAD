<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ServSoportePres extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public $timestamps=false;
    public function up()
    {
        Schema::create('presenciales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('plan_id')->unsigned();
            $table->string('etiqueta',100);
            $table->integer('valor')->unsigned();
            $table->float('precio');
            $table->foreign('plan_id')->references('id')->on('planes')->onDelate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('presenciales');
    }
}
