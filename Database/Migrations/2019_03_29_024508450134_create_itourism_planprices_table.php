<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItourismPlanPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itourism__planprices', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('plan_id')->unsigned();
            $table->foreign('plan_id')->references('id')->on('itourism__plans')->onDelete('cascade');
            $table->integer('roomtype_id')->unsigned();
            $table->foreign('roomtype_id')->references('id')->on('itourism__roomtypes')->onDelete('cascade');
            $table->integer('persontype_id')->unsigned();
            $table->foreign('persontype_id')->references('id')->on('itourism__persontypes')->onDelete('cascade');
            $table->double('price', 30, 2)->default(0);
            $table->double('additional_night_price', 30, 2)->default(0);
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
      Schema::table('itourism__roomtypes_translations', function (Blueprint $table) {
          $table->dropForeign(['plan_id']);
          $table->dropForeign(['roomtype_id']);
          $table->dropForeign(['persontype_id']);
      });
        Schema::dropIfExists('itourism__planprices');
    }
}
