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
            $table->tinyInteger('type');
            $table->tinyInteger('state')->default(0);
            $table->string('username')->unique()->nullable();
            $table->string('email');
            $table->string('password')->nullable();

            $table->integer('region_id')->nullable()->unsigned();
            $table->integer('city_id')->nullable()->unsigned();
            $table->string('neighborhood');
            $table->string('subject')->nullable();
            $table->date('reg_date')->nullable();
            $table->string('inn', 9)->nullable();
            $table->string('bank_name')->nullable();
            $table->string('mfo', 5)->nullable();
            $table->string('address');
            $table->string('phone', 13);
            $table->string('fullName');
            $table->integer('labors')->nullable()->unsigned();
            $table->timestamps();
            $table->rememberToken();

        });
        Schema::table('users', function($table) {
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
