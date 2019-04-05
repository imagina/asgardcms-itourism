<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItourismRoomTypesTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itourism__roomtypes_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title');
            $table->text('description');
            $table->integer('room_types_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['room_types_id', 'locale']);
            $table->foreign('room_types_id')->references('id')->on('itourism__roomtypes')->onDelete('cascade');
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
            $table->dropForeign(['room_types_id']);
        });
        Schema::dropIfExists('itourism__roomtypes_translations');
    }
}
