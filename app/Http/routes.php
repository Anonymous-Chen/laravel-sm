<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::any('student/request1',['uses'=>'StudentController@request1']);

Route::get('student/a',['uses'=>'StudentController@a']);

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    Route::get('student/index',['uses'=>'StudentController@index']);
    Route::any('student/create',['uses'=>'StudentController@create']);
    Route::any('student/save',['uses'=>'StudentController@save']);
    Route::any('student/update/{id}',['uses'=>'StudentController@update']);
    Route::any('student/delete/{id}',['uses'=>'StudentController@delete']);
    Route::any('student/detail/{id}',['uses'=>'StudentController@detail']);
});

//在最后的.env 文件中改数据库，中间件在， get与any的区别
