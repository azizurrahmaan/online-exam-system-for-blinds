<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Examination;

class ExaminationsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $examinations = \App\Examination::all();
        return view('examinations.view_all',[
            'examinations' => $examinations
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $examinations = \App\Examination::all();
        return view('examinations.create',[
            'examinations' => $examinations
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'name' => ['required', 'string', 'regex:/^[A-Za-z0-9\?.",() ]*$/', 'max:255'],
            'total_questions' => ['required', 'numeric', 'min:1'],
            'passing_percentage' => ['required', 'numeric', 'min:1'],
            'duration_for_non_blind' => ['required', 'numeric', 'min:1'],
            'duration_for_blind' => ['numeric'],
        ]);

        $examination = request()->except('_token');
        $examination['duration_for_blind'] = $examination['duration_for_non_blind'] + 30;
        \App\Examination::SaveExamination($examination);
        return redirect('/examinations')->with("add_new_qustion_in_exam_success", "New Question was added successfuly in Exam and Pool.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Examination $examination)
    {
        $not_included_questions = \App\ExamQuestion::GetNotIncludedQuestionsForExam($examination);
        $included_questions = \App\ExamQuestion::GetIncludedQuestionsForExam($examination);
        return view('examinations.view',[
            'examination' => $examination,
            'not_included_questions' => $not_included_questions,
            'included_questions' => $included_questions,
            'included_questions_count' => count($included_questions),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Examination $examination)
    {
        // return view('examinations.edit', [
        //     'exaination' => $examination
        // ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Examination $examination)
    {
        // $this->validate(request(), [
        //     'name' => ['required', 'string', 'regex:/^[A-Za-z0-9\?.",() ]*$/', 'max:255'],
        //     'total_questions' => ['required', 'numeric'],
        //     'passing_percentage' => ['required', 'numeric'],
        //     'duration_for_non_blind' => ['required', 'numeric'],
        //     'duration_for_blind' => ['numeric'],
        // ]);

        // $examination = request()->except('_token', '_method');
        // \App\Question::UpdateExamination($examination, $u_examination);
        // return back();  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Examination $examination)
    {
        // $examination->forceDelete();
        // return back();
    }

    public function addQuestions(Examination $examination)
    {
        $not_included_questions = \App\ExamQuestion::GetNotIncludedQuestionsForExam($examination);
        $included_questions = \App\ExamQuestion::GetIncludedQuestionsForExam($examination);

        if($examination->total_question_added == $examination->total_questions){
            return redirect()->route('examinations.view', ['examination'=> $examination]);
        }else{
            return view('examinations.add_questions',[
                'examination' => $examination,
                'not_included_questions' => $not_included_questions,
                'included_questions' => $included_questions,
                'included_questions_count' => count($included_questions),
            ]);
        }
    }

    public function saveQuestions(Request $request, Examination $examination)
    {
        $not_included_questions = \App\ExamQuestion::GetNotIncludedQuestionsForExam($examination);
        $included_questions = \App\ExamQuestion::GetIncludedQuestionsForExam($examination);
        $addded_questions_count = count($included_questions);
        $to_be_added_questions_count = count($request->question_to_be_added);
        if($addded_questions_count + $to_be_added_questions_count > $examination->total_questions){
            return redirect()->route('examinations.add_question', ['examination'=> $examination])->with('question_count_exceed_error', 'Selected Questions were more than number of Maximum Questions for Exam!');
        }else{
            \App\ExamQuestion::SaveExamQuestions($examination, $request->question_to_be_added);
            $examination->total_questions_added = $addded_questions_count + $to_be_added_questions_count;
            $examination->save();
            if($addded_questions_count + $to_be_added_questions_count == $examination->total_questions){
                return redirect()->route('examinations.view', ['examination'=> $examination])->with('questions_added_success', 'Selected Question(s) from pool Were Successfuly Added in Exam.');
            }else{
                return redirect()->route('examinations.add_question', ['examination'=> $examination])->with('questions_added_success', 'Selected Question(s) from pool Were Successfuly Added in Exam.');
            }
        }
    }
}
