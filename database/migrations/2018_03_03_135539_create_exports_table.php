<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exports', function (Blueprint $table) {
            $table->increments('id');
            $table->double('annual_power')->unsigned()->nullable();
            $table->integer('shops_count')->unsigned();
            $table->string('shops_address')->nullable();
            $table->double('packed_honey')->unsigned()->nullable();
            $table->double('inside_quantity')->unsigned()->nullable();
            $table->integer('inside_price')->unsigned()->nullable();
            $table->double('outside_quantity')->unsigned()->nullable();
            $table->integer('outside_price')->unsigned()->nullable();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('exports');
    }
}
