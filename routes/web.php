<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['confirm' => false, 'email' => false, 'request' => false, 'update' => false, 'reset' => false]);

Route::group(['middleware' => ['verify_admin']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/students', 'Auth\RegisterController@showRegistrationForm')->name('students');
    Route::get('students/{user}', 'StudentsController@edit')->name('students.edit');
    Route::patch('students/{user}/update', 'StudentsController@update')->name('students.update');
    Route::delete('students/{user}', 'StudentsController@destroy')->name('students.delete');
    Route::get('/administrators', 'Auth\RegisterController@showRegistrationForm')->name('administrators');

    Route::resource('/questions', 'QuestionsController',[
        'names' => [
            'index' => 'questions',
            'store' => 'question.save',
            'edit' => 'question.edit',
            'destroy' => 'question.delete',
            'update' => 'question.update',
        ]
    ]);

    Route::resource('/examinations', 'ExaminationsController',[
        'names' => [
            'index' => 'examinations',
            'create' => 'examinations.create',
            'store' => 'examination.save',
            'edit' => 'examination.edit',
            'destroy' => 'examination.delete',
            'update' => 'examination.update',
            'show' => 'examinations.view',
        ]
    ]);

    Route::get('/examinations/{examination}/add_questions', 'ExaminationsController@addQuestions')->name('examinations.add_question');
    Route::post('/examinations/{examination}/save_questions', 'ExaminationsController@saveQuestions')->name('examinations.save_questions');
});


Route::group(['middleware' => ['verify_student']], function () {
    Route::get('/student_portal/dashboard', 'StudentsController@dashboard')->name('students.dashboard');
    Route::get('/student_portal/unattempted_examinations', 'StudentsController@viewUnAttmptedExaminations')->name('students.unattempted_examinations');
    Route::get('/student_portal/attempted_examinations', 'StudentsController@viewAttmptedExaminations')->name('students.attempted_examinations');
    Route::get('/student_portal/unattempted_examinations/{examination}/attempt', 'StudentsController@viewUnattemptedExaminationToAttempt')->name('students.attempt_examination');
    Route::post('/student_portal/unattempted_examinations/{examination}/do_attempt', 'StudentsController@doAttemptExam')->name('students.do_attempt_examination');
    Route::post('/student_portal/unattempted_examinations/{examination}/save_attempted_exam', 'StudentsController@saveAttemptedExam')->name('students.save_attempted_exam');
    Route::get('/student_portal/attempted_examinations/{examination}/result', 'StudentsController@showResult')->name('students.attempted_examination_result');
});