<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatosRegistraduriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_registradurias', function (Blueprint $table) {
            $table->integer('id');
            $table->string('nombre',80);
            $table->string('direccion',80);
            $table->double('censom', 8, 2);
            $table->double('censoh', 8, 2);
            $table->double('potencialelectoral', 8, 2);
            $table->integer('numeromesa', 8, 2);
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
        Schema::dropIfExists('datos_registradurias');
    }
}
