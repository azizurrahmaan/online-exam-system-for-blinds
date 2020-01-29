<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class APIController extends Controller
{
    public function getMinutesRemaining(Request $request)
    {
        $exam = \App\Examination::findOrFail($request->exam_id);
        $std = \App\User::findOrFail($request->std_id);
        $exam_status = \App\ExaminationAttempt::GetExamStatus($request->std_id, $request->exam_id)->first();
        $remaining_time = strtotime(date("Y-m-d H:i:s", strtotime('now'))) - strtotime(date("Y-m-d H:i:s", strtotime($exam_status['start_time'])));
        $exam_duration = ($std->role == 'Non-Blind Student')?$exam->duration_for_non_blind:($std->role == 'Blind Student')?$exam->duration_for_blind:0;
        $time_elapsed = intval($remaining_time/60);
        if($time_elapsed >= $exam_duration){
            return ['time_elapsed'=>'timeup'];
        }else{
            return ['time_elapsed'=>$remaining_time] ;
        }
    }
}
