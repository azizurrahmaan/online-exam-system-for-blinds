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