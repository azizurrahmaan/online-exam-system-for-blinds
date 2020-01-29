<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExaminationAttempt extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['examination_id', 'student_id', 'start_time', 'end_time'];

    public function scopeStoreExamimnationAttepmt($query, $student_id, $exam_id, $start_time, $end_time)
    {
           $ea =  ExaminationAttempt::updateOrCreate(
               [
                'examination_id' => $exam_id,
                'student_id' => $student_id,
                'start_time' => $start_time,
                'end_time' => $end_time,
               ]
           );
    }

    public function scopeGetExamStatus($query, $student_id, $exam_id)
    {
        $result = $this->select('*')
        ->where('examination_id','=',$exam_id)
        ->where('student_id','=',$student_id);
        return $result->get();
    }
}
