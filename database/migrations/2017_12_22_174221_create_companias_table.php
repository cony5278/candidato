<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('imagen',50)->nullable();
            $table->integer('id_ano')->unsigned()->nullable();
            $table->foreign('id_ano')
                ->references('id')
                ->on('anos');
            $table->integer('id_mes')->unsigned()->nullable();
            $table->foreign('id_mes')
                ->references('id')
                ->on('mes');
            $table->integer('dia')->nullable();
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
        Schema::dropIfExists('companias');
    }
}
