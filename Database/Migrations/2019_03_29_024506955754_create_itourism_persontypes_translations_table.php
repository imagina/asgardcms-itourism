<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItourismPersonTypesTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itourism__persontypes_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title');
            $table->text('description');
            $table->integer('person_types_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['person_types_id', 'locale']);
            $table->foreign('person_types_id')->references('id')->on('itourism__persontypes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('itourism__persontypes_translations', function (Blueprint $table) {
            $table->dropForeign(['person_types_id']);
        });
        Schema::dropIfExists('itourism__persontypes_translations');
    }
}
