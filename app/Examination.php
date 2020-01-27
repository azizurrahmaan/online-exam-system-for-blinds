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
        $q->save();
    }
}
