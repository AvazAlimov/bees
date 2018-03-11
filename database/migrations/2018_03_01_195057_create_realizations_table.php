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
            $table->integer('family_count')->unsigned();
            $table->double('annual_prog')->unsigned();
            $table->double('produced_honey')->unsigned();
            $table->double('reserve')->unsigned();
            $table->double('realized_quantity')->unsigned();
            $table->integer('realized_price')->unsigned();
            $table->double('stock_quantity')->unsigned();
            $table->integer('stock_price')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('month')->unsigned();
            $table->integer('year')->unsigned();
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
