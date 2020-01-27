<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExaminationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examinations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->String('name');
            $table->unsignedDecimal('passing_percentage');
            $table->unsignedInteger('duration_for_blind');
            $table->unsignedInteger('duration_for_non_blind');
            $table->unsignedInteger('total_questions');
            $table->unsignedInteger('total_questions_added')->default(0);
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
        Schema::dropIfExists('examinations');
    }
}
