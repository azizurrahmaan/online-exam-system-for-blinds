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
Route::get('/students', 'Auth\RegisterController@showRegistrationForm')->name('students');
Route::get('students/{user}', 'StudentsController@edit')->name('students.edit');
Route::patch('students/{user}/update', 'StudentsController@update')->name('students.update');
Route::delete('students/{user}', 'StudentsController@destroy')->name('students.delete');
Route::get('/administrators', 'Auth\RegisterController@showRegistrationForm')->name('administrators');