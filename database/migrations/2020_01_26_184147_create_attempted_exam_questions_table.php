<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttemptedExamQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attempted_exam_questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->unsignedBigInteger('exam_question_id');
            $table->foreign('exam_question_id')->references('id')->on('exam_questions');
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('id')->on('users');
            $table->string('correct_option');
            $table->timestamps();
        });
        
        DB::statement("ALTER TABLE `results` ADD UNIQUE `student_exam_result_unique`(`student_id`, `exam_question_id`);");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attempted_exam_questions');
    }
}
