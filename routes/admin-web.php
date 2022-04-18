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



Route::middleware(['guest.admin'])->group(function () {
    Route::get('/', 'admin\LoginController@showLoginPage');
    Route::get('/login', 'admin\LoginController@showLoginPage')->name('admin/showLoginPage');
    Route::post('/login', 'admin\LoginController@login')->name('admin/login');
 
});

Route::middleware(['auth.admin'])->group(function () {
    
    /*
    * Manage Exams Routes
    */
    Route::get('/exams', 'admin\ExamController@index')->name('admin/exams');
    Route::get('get-exam-list', 'admin\ExamController@getExamList')->name('admin/getExamList');
    Route::post('exam/import', 'admin\ExamController@importExam')->name('admin/exam/import');
    Route::get('exam/export', 'admin\ExamController@export')->name('admin/exam/export');

});

Route::get('/logout', 'admin\LoginController@logout')->name('admin/logout');