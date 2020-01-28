<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Examination extends Model
{
     /**
     * Get the ExamQuestion record associated with the Exam.
     */
    public function exam_questions()
    {
        return $this->hasMany('App\ExamQuestion');
    }

    public function scopeSaveExamination($query,$examination)
    {
        $e = new Examination();
        $e->name=$examination['name'];
        $e->total_questions=$examination['total_questions'];
        $e->passing_percentage=$examination['passing_percentage'];
        $e->duration_for_non_blind=$examination['duration_for_non_blind'];
        $e->duration_for_blind=$examination['duration_for_blind'];
        $e->save();
    }

    public function scopeUpdateQuestion($query, $e, $u_exam)
    {
        // $q->save();
    }

    public function scopeGetUnAttemptedExaminationsForStudent($query, $std_id)
    {
        $result = $this->select('*')->whereNotIn('id',function ($query) use ($std_id) {
            $query->select('exam_questions.examination_id')
            ->from('exam_questions')
            ->join('attempted_exam_questions','exam_questions.id', '=', 'attempted_exam_questions.exam_question_id')
            ->where('attempted_exam_questions.student_id','=',$std_id);
        })->whereRaw('examinations.total_questions = examinations.total_questions_added');
        return $result->get();
    }

    public function scopeGetAttemptedExaminationsForStudent($query, $std_id)
    {
        $result = $this->select('*')->whereIn('id',function ($query) use ($std_id) {
            $query->select('exam_questions.examination_id')
            ->from('exam_questions')
            ->join('attempted_exam_questions','exam_questions.id',  '=', 'attempted_exam_questions.exam_question_id')
            ->where('attempted_exam_questions.student_id','=',$std_id);
        });
        return $result->get();
    }
}
