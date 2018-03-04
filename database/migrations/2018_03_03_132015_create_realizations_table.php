<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRealizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('realizations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('family_count')->unsigned()->nullable();
            $table->double('annual_prog')->unsigned()->nullable();
            $table->double('produced_honey')->unsigned()->nullable();
            $table->double('reserve')->unsigned()->nullable();
            $table->double('realized_quantity')->unsigned()->nullable();
            $table->integer('realized_price')->unsigned()->nullable();
            $table->double('stock_quantity')->unsigned()->nullable();
            $table->integer('stock_price')->unsigned()->nullable();
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
        Schema::dropIfExists('realizations');
    }
}
