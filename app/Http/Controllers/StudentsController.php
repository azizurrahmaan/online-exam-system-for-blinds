<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use \App\Examination;

class StudentsController extends Controller
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

    public function index()
    {
        return redirect()->route('register');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {   
        $user = \App\User::findorFail($id);
        return view('users.edit', ['user'=> $user]);
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(int $id)
    { 
        
        $this->validate(request(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id.',id'],
            'password' => ['string', 'min:8', 'confirmed'],
            'role' => ['required', 'string'],
        ]);
        
        
        $user = \App\User::findorFail($id);
        $user->name = request('name');
        $user->email = request('email');
        $user->role = request('role');

        if(request('password')){
            $user->password = Hash::make(request('password'));
        }

        $user->save();

        return back()->with('student_update_success', 'Student updated successfuly!');
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = \App\User::findorFail($id);
        $user->forceDelete();
        return back()->with('student_delete_success', 'Student deleted successfuly!');
    }

    public function dashboard()
    {
        $unattempted_examinations = \App\Examination::GetUnAttemptedExaminationsForStudent(Auth::user()->id);
        $exam_count = count($unattempted_examinations);
        return view('students.dashboard',[
            'exam_count' => $exam_count,
            'examination' => null,
        ]);
    }

    public function viewUnAttmptedExaminations()
    {
        $unattempted_examinations = \App\Examination::GetUnAttemptedExaminationsForStudent(Auth::user()->id);
        $exam_count = count($unattempted_examinations);
        return view('students.view_unattempted_examinations',[
            'unattempted_examinations' => $unattempted_examinations,
            'exam_count' => $exam_count,
        ]);
    }

    public function viewAttmptedExaminations()
    {
        $unattempted_examinations = \App\Examination::GetUnAttemptedExaminationsForStudent(Auth::user()->id);
        $attempted_examinations = \App\Examination::GetAttemptedExaminationsForStudent(Auth::user()->id);
        $exam_count = count($unattempted_examinations);
        return view('students.view_attempted_examinations',[
            'attempted_examinations' => $attempted_examinations,
            'exam_count' => $exam_count,
        ]);
    }

    public function viewAttmptedExaminationsToAdmin(int $std_id)
    {   
        $std = \App\User::findOrFail($std_id);
        $unattempted_examinations = \App\Examination::GetUnAttemptedExaminationsForStudent($std_id);
        $attempted_examinations = \App\Examination::GetAttemptedExaminationsForStudent($std_id);
        $exam_count = count($unattempted_examinations);
        return view('students.view_attempted_examinations_to_admin',[
            'attempted_examinations' => $attempted_examinations,
            'exam_count' => $exam_count,
            'student' => $std,
        ]);
    }

    public function viewUnattemptedExaminationToAttempt(int $exam_id)
    {
        $exam = \App\Examination::findOrFail($exam_id);
        $unattempted_examinations = \App\Examination::GetUnAttemptedExaminationsForStudent(Auth::user()->id);
        $flag = false;
        foreach($unattempted_examinations as $examination){
            if($examination->id == $exam->id){
                $flag = true;
                break;
            }
        }
        if(!$flag){// exam already attempted
            return redirect()->route('students.dashboard');
        }
        else{
            $exam_count = count($unattempted_examinations);
            return view('students.view_exam_to_attempt',[
                'examination' => $exam,
                'exam_count' => $exam_count,
            ]);
        }
    }

    public function doAttemptExam(Request $request, int $exam_id)
    {
        $exam = \App\Examination::findOrFail($request->examination_id);
        $exam_questions = \App\ExamQuestion::GetExamQuestions($exam);
        $unattempted_examinations = \App\Examination::GetUnAttemptedExaminationsForStudent(Auth::user()->id);
        $flag = false;
        foreach($unattempted_examinations as $examination){
            if($examination->id == $exam->id){
                $flag = true;
                break;
            }
        }
        if(!$flag){// exam already attempted
            return redirect()->route('students.dashboard');
        }else{
            $exam_count = count($unattempted_examinations);
            return view('students.attempt_exam',[
                'examination' => $exam,
                'exam_questions' => $exam_questions,
                'exam_count' => $exam_count,
            ]);
        }
        
    }

    public function saveAttemptedExam(Request $request, int $exam_id)
    {
        $exam = \App\Examination::findOrFail($exam_id);
        $attemtations = $request->except('_token');
        foreach($attemtations as $key => $value){
            \App\AttemptedExamQuestion::saveAttemptedExamQuestion(Auth::user()->id, $key, $value);  
        }
        return redirect()->route('students.attempted_examination_result',['examination'=> $exam_id]);
    }

    public function showResult(int $exam_id)
    {
        $exam = \App\Examination::findOrFail($exam_id);
        $unattempted_examinations = \App\Examination::GetUnAttemptedExaminationsForStudent(Auth::user()->id);
        $flag = false;
        foreach($unattempted_examinations as $examination){
            if($examination->id == $exam->id){
                $flag = true;
                break;
            }
        }
        if($flag){// exam not attempted
            return redirect()->route('students.dashboard');
        }
        else{
            $exam_count = count($unattempted_examinations);
            $attempted_exam_questions = \App\AttemptedExamQuestion::GetAttemptedExamQuestions(Auth::user()->id, $exam_id);
            $student = Auth::user();
            return view('students.exam_result',[
                'examination' => $exam,
                'student' => $student,
                'exam_count' => $exam_count,
                'attempted_exam_questions' => $attempted_exam_questions,
            ]);
        }
    }

    public function showResultToAdmin(int $exam_id, int $std_id)
    {
        $student = \App\User::findOrFail($std_id);
        $exam = \App\Examination::findOrFail($exam_id);
        $unattempted_examinations = \App\Examination::GetUnAttemptedExaminationsForStudent($student->id);
        $flag = false;
        foreach($unattempted_examinations as $examination){
            if($examination->id == $exam->id){
                $flag = true;
                break;
            }
        }
        if($flag){// exam not attempted
            return redirect()->route('students.dashboard');
        }
        else{
            $exam_count = count($unattempted_examinations);
            $attempted_exam_questions = \App\AttemptedExamQuestion::GetAttemptedExamQuestions($student->id, $exam_id);
            return view('students.exam_result',[
                'examination' => $exam,
                'student' => $student,
                'exam_count' => $exam_count,
                'attempted_exam_questions' => $attempted_exam_questions,
            ]);
        }
    }
}
