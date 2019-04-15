<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItourismPlanTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itourism__plan_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title');
            $table->text('description');
            $table->string('slug');
            $table->text('includes')->default('')->nullable();
            $table->text('notincludes')->default('')->nullable();
            $table->text('notes')->default('')->nullable();
            $table->text('payforms')->default('')->nullable();
            $table->string('metatitle')->nullable();
            $table->text('metakeywords')->nullable();
            $table->text('metadescription')->nullable();
            $table->integer('plan_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['plan_id', 'locale']);
            $table->foreign('plan_id')->references('id')->on('itourism__plans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('itourism__plan_translations', function (Blueprint $table) {
            $table->dropForeign(['plan_id']);
        });
        Schema::dropIfExists('itourism__plan_translations');
    }
}
