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
            $table->integer('region_id')->nullable()->unsigned();
            $table->integer('city_id')->nullable()->unsigned();
            $table->string('neighborhood');
            $table->string('subject');
            $table->date('reg_date');
            $table->string('inn', 9);
            $table->string('mfo', 5);
            $table->string('address');
            $table->string('phone', 13);
            $table->string('fullName');
            $table->integer('labors')->unsigned();
            $table->timestamps();
            $table->rememberToken();

            $table->foreign('region_id')->references('id')->on('regions')->onDelete('set null');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('set null');
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
