<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;

class QuestionsController extends Controller
{
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
        $questions = Question::all();

        return view('questions.create_and_view', [
            'questions' => $questions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'subject' => ['required', 'string', 'max:255', 'regex:/^[A-Za-z0-9\?.",() ]*$/'],
            'question_text' => ['required', 'string', 'regex:/^[A-Za-z0-9\?.",() ]*$/'],
            'option_a' => ['required', 'string', 'regex:/^[A-Za-z0-9\?.",() ]*$/'],
            'option_b' => ['required', 'string', 'regex:/^[A-Za-z0-9\?.",() ]*$/'],
            'option_c' => ['string', 'regex:/^[A-Za-z0-9\?.",() ]*$/'],
            'option_d' => ['string', 'regex:/^[A-Za-z0-9\?.",() ]*$/'],
            'option_e' => ['string', 'regex:/^[A-Za-z0-9\?.",() ]*$/'],
            'correct_option' => ['required', 'string', 'max:1', 'min:1', 'regex:/^[A-Z]*$/'],
        ]);
        
        $question = request()->except('_token');
        $question_id = \App\Question::SaveQuestion($question);
        if(request('examination')){
            $exam = \App\Examination::findOrFail(request('examination'));
            \App\ExamQuestion::SaveExamQuestion($exam,$question_id);
            $exam->total_questions_added = $exam->total_questions_added + 1;
            $exam->save();
            return redirect()->route('examinations.add_question',['examination'=> $exam])->with("add_new_qustion_in_exam_success", "New Question was added successfuly in Exam and Pool.");;
        }else{
            return redirect('/questions')->with("add_new_qustion_in_pool", "New Question was added successfuly in Pool.");;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        return view('questions.edit', [
            'question' => $question
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        $this->validate(request(), [
            'subject' => ['required', 'string', 'max:255', 'regex:/^[A-Za-z0-9\?.",() ]*$/'],
            'question_text' => ['required', 'string', 'regex:/^[A-Za-z0-9\?.",() ]*$/'],
            'option_a' => ['required', 'string', 'regex:/^[A-Za-z0-9\?.",() ]*$/'],
            'option_b' => ['required', 'string', 'regex:/^[A-Za-z0-9\?.",() ]*$/'],
            'option_c' => ['string', 'regex:/^[A-Za-z0-9\?.",() ]*$/'],
            'option_d' => ['string', 'regex:/^[A-Za-z0-9\?.",() ]*$/'],
            'option_e' => ['string', 'regex:/^[A-Za-z0-9\?.",() ]*$/'],
            'correct_option' => ['required', 'string', 'max:1', 'min:1', 'regex:/^[A-Z]*$/'],
        ]);

        $u_question = request()->except('_token', '_method');
        \App\Question::UpdateQuestion($question, $u_question);

        return back()->with('question_update_success', 'Question updated successfuly!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        // $question->forceDelete();
        // return back()->with('question_delete_success', 'Question deleted successfuly!');;
    }
}
