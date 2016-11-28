<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearCampoStatusClientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public $timestamos=false;
    public function up()
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->integer('statusC')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->dropColumn('statusC');
        });
    }
}