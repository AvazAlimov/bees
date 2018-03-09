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
            $table->double('annual_power')->unsigned();
            $table->integer('shops_count')->unsigned();
            $table->string('shops_address');
            $table->double('packed_honey')->unsigned();
            $table->double('inside_quantity')->unsigned();
            $table->integer('inside_price')->unsigned();
            $table->double('outside_quantity')->unsigned();
            $table->integer('outside_price')->unsigned();
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
        Schema::dropIfExists('exports');
    }
}
