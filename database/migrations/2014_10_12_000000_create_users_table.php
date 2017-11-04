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
            $table->string('username')->unique();
            $table->string('email');
            $table->string('password');
            $table->tinyInteger('type');

            $table->rememberToken();

            $table->integer('region_id')->unsigned();
            $table->integer('city_id')->unsigned();
            $table->string('neighborhood');
            $table->string('subject');
            $table->date('reg_date');
            $table->string('inn',9);
            $table->string('mfo',5);
            $table->string('address');
            $table->string('tel',13);
            $table->string('fullName');
            $table->integer('labors')->unsigned();

            $table->foreign('region_id')->references('id')->on('regions');
            $table->foreign('city_id')->references('id')->on('cities');

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
