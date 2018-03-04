<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFamilyRealizationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('family_realization', function (Blueprint $table) {
            $table->integer('family_id')->unsigned();
            $table->foreign('family_id')->references('id')->on('families')->onDelete('cascade');

            $table->integer('realization_id')->unsigned();
            $table->foreign('realization_id')->references('id')->on('realizations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('family_realization');
    }
}
