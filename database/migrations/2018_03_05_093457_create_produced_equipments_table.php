<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProducedEquipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produced_equipments', function (Blueprint $table) {
            $table->integer('equipment_id')->unsigned();
            $table->integer('production_id')->unsigned();
            $table->double('volume');
            $table->primary(['equipment_id','production_id']);
            $table->timestamps();
        });
        Schema::table('produced_equipments', function ($table) {
            $table->foreign('production_id')->references('id')->on('productions')->onDelete('cascade');
            $table->foreign('equipment_id')->references('id')->on('equipments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produced_equipments');
    }
}
