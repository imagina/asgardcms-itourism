<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncludeNotincludeNotesFieldsPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('itourism__plan_translations', function (Blueprint $table) {
            $table->text('includes')->default('')->nullable();
            $table->text('notincludes')->default('')->nullable();
            $table->text('notes')->default('')->nullable();
            $table->text('payforms')->default('')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
