<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMesasVotacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mesas_votacions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('numero');
            $table->integer('id_punto')->unsigned();
            $table->foreign('id_punto')
                ->references('id')
                ->on('puntos_votacions');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mesas_votacions');
    }
}
