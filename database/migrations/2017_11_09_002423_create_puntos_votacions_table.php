<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePuntosVotacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('puntos_votacions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',60)->nullable();
            $table->string('direccion',60);
            $table->integer('id_ciudad')->unsigned();
            $table->foreign('id_ciudad')
                ->references('id')
                ->on('ciudades');
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
        Schema::dropIfExists('puntos_votacions');
    }
}
