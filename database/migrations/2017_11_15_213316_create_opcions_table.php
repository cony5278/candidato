<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpcionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opcions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_socioeconomica')->unsigned()->nullable();
            $table->foreign('id_socioeconomica')
                ->references('id')
                ->on('socioeconomicas');
            $table->integer('id_poblacions')->unsigned()->nullable();
            $table->foreign('id_poblacions')
                ->references('id')
                ->on('poblacions');
            $table->integer('id_areaconocimientos')->unsigned()->nullable();
            $table->foreign('id_areaconocimientos')
                ->references('id')
                ->on('areaconocimientos');
            $table->integer('id_otros')->unsigned()->nullable();
            $table->foreign('id_otros')
                ->references('id')
                ->on('otros');
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
        Schema::dropIfExists('opcions');
    }
}
