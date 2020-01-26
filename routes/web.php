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
Route::get('/students', 'StudentsController@index')->name('students');
