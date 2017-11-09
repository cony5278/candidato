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
            $table->string('id',15)->primary();
            $table->string('name')->nullable();
            $table->string('name2');
            $table->string('lastname')->nullable();
            $table->string('lastname2');
            $table->string('nit');
            $table -> enum ( 'type',['S' , 'A' ] )->default("A");
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('id_mesa')->unsigned()->nullable();
            $table->foreign('id_mesa')
                ->references('id')
                ->on('mesas_votacions');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
