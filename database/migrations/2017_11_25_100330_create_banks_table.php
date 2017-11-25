<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mfo',5)->unique();
            $table->string('name');
            $table->timestamps();
            // $table->string('code_directory', 3);
            // $table->integer('region_id')->unsigned();
            //  $table->integer('city_id')->unsigned();
            // $table->string('code_office', 5);
            // $table->string('code_serving_territorial_center', 5);
            // $table->string('code_serving_cash_center', 5);
            // $table->string('address');
            // $table->string('code_status_bank', 2);
            // $table->string('electronic_payments',1);
            // $table->date('reg_date');
            // $table->date('close_date')->nullable();
            // $table->string('activity', 1);
            // $table->string('email_office')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banks');
    }
}
