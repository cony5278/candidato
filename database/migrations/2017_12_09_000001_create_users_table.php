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
            $table->string('email',90)->unique();
            $table->string('password')->nullable();
            $table->string('telefonofijo',11)->nullable();
            $table->string('telefonomovil',11)->nullable();
            $table->dateTime('birthdate')->nullable();
            $table->string('photo')->default("default.png");
            $table->integer('id_mesa')->unsigned()->nullable();
            $table->foreign('id_mesa')
                ->references('id')
                ->on('mesas_votacions');
            $table->integer('id_opcions')->unsigned()->nullable();
            $table->foreign('id_opcions')
                ->references('id')
                ->on('opcions');
            $table->integer('id_empresa')->unsigned()->nullable();
            $table->foreign('id_empresa')
                ->references('id')
                ->on('empresas');
            $table->integer('id_referido')->unsigned()->nullable();
            $table->foreign('id_referido')
                ->references('id')
                ->on('users');
            $table->integer('potencial')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->string('address',40)->nullable();
            $table -> enum ( 'sex',['F' , 'M','O'])->nullable();
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
