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
            $table->string('id',15)->primary();
            $table->string('nombre',60);
            $table->string('direccion',60);
            $table->string('id_ciudad',15);
            $table->foreign('id_ciudad')
                ->references('id')->on('ciudades');
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
