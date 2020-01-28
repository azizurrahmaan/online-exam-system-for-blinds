<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttemptedExamQuestion extends Model
{
    public function scopeSaveAttemptedExamQuestion($query, $student_id, $exam_question_id, $choosen_option)
    {
        $aq = new AttemptedExamQuestion();
        $aq->student_id = $student_id;
        $aq->exam_question_id = $exam_question_id;
        $aq->choosed_option = $choosen_option;
        $aq->save();
    }

    public function scopeGetAttemptedExamQuestions($query, $student_id, $exam_id)
    {
        $result = $this->select('*')
        ->join('exam_questions', 'attempted_exam_questions.exam_question_id','=','exam_questions.id')
        ->join('questions', 'exam_questions.question_id','=','questions.id')
        ->join('examinations', 'exam_questions.examination_id','=','examinations.id')
        ->where('attempted_exam_questions.student_id', '=', $student_id)
        ->where('exam_questions.examination_id', '=', $exam_id);

        return $result->get();
    }
}
