<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    
    public function scopeSaveQuestion($query,$question)
    {
        $q = new Question();
        $q->subject = $question['subject'];
        $q->question_text = $question['question_text'];
        $q->option_a = $question['option_a'];
        $q->option_b = $question['option_b'];
        if(array_key_exists('option_c', $question))
            $q->option_c = $question['option_c'];
        if(array_key_exists('option_d', $question))
            $q->option_d = $question['option_d'];
        if(array_key_exists('option_e', $question))
            $q->option_e = $question['option_e'];
        $q->correct_option = $question['correct_option'];
        $q->save();
    }

    public function scopeUpdateQuestion($query, $q, $u_question)
    {
        $q->subject = $u_question['subject'];
        $q->question_text = $u_question['question_text'];
        $q->option_a = $u_question['option_a'];
        $q->option_b = $u_question['option_b'];
        if(array_key_exists('option_c', $u_question))
            $q->option_c = $u_question['option_c'];
        if(array_key_exists('option_d', $u_question))
            $q->option_d = $u_question['option_d'];
        if(array_key_exists('option_e', $u_question))
            $q->option_e = $u_question['option_e'];
        $q->correct_option = $u_question['correct_option'];
        $q->save();
    }
}
