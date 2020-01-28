<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamQuestion extends Model
{
    public function scopeGetNotIncludedQuestionsForExam($query, $exam)
    {
        $result =  \DB::select('select * from questions where id not in (select question_id from exam_questions where exam_questions.examination_id = ?)',[
            $exam->id
        ]);

        return $result;
    }

    public function scopeGetIncludedQuestionsForExam($query, $exam)
    {
        $result =  \DB::select('select * from questions where id in (select question_id from exam_questions where exam_questions.examination_id = ?)',[
            $exam->id
        ]);

        return $result;
    }

    public function scopeGetExamQuestions($query, $exam)// to attempt exam
    {
        $result =  $this->select('exam_questions.id AS exam_question_id', 'questions.*')
        ->join('questions','questions.id','=','exam_questions.question_id')
        ->where('exam_questions.examination_id','=',$exam->id);
        return $result->get();
    }

    
    public function scopeSaveExamQuestion($query, $exam, $question_id)
    {
        $eq = new ExamQuestion();
        $eq->examination_id = $exam->id;
        $eq->question_id = $question_id;
        $eq->save();
    }

    public function scopeSaveExamQuestions($query, $exam, $question_ids)
    {
        foreach($question_ids as $question_id){
            $eq = new ExamQuestion();
            $eq->examination_id = $exam->id;
            $eq->question_id = $question_id;
            $eq->save();
        }
    }
}
