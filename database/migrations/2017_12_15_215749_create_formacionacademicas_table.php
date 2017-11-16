<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormacionacademicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formacionacademicas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_nivelacademicos')->unsigned()->nullable();
            $table->foreign('id_nivelacademicos')
                ->references('id')
                ->on('nivelacademicos');
            $table->integer('id_usuario')->unsigned()->nullable();
            $table->foreign('id_usuario')
                ->references('id')
                ->on('users');
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
        Schema::dropIfExists('formacionacademicas');
    }
}
