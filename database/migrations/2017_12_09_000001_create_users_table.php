<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('name2')->nullable();
            $table->string('lastname')->nullable();
            $table->string('lastname2')->nullable();
            $table->string('nit')->nullable();
            $table -> enum ( 'type',['S' , 'A' ,'E'] );
            $table->string('email')->unique();
            $table->string('password');
            $table->string('photo')->default("default.png");
            $table->integer('id_mesa')->unsigned()->nullable();
            $table->foreign('id_mesa')
                ->references('id')
                ->on('mesas_votacions');
            $table->integer('id_opcions')->unsigned()->nullable();
            $table->foreign('id_opcions')
                ->references('id')
                ->on('opcions');
            $table->rememberToken();
            $table->timestamps();
            $table->string('address',40)->nullable();
            $table -> enum ( 'sex',['F' , 'M'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
