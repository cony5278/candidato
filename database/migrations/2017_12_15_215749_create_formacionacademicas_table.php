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
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->string('descripcion',60)->nullable();
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
