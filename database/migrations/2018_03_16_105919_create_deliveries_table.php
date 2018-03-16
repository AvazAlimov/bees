<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('region_id')->unsigned();
            $table->integer('city_id')->unsigned();
            $table->string('subject');
            $table->string('address');
            $table->integer('family_count')->unsigned();
            $table->integer('really_delivered')->unsigned();
            $table->double('price');
            $table->string('factory_name');
            $table->string('name');
            $table->string('phone');

            $table->foreign('region_id')->references('id')->on('regions')->onDelete('cascade');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
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
        Schema::dropIfExists('deliveries');
    }
}
