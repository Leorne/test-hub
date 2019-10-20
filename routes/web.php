<?php

Auth::routes();

//Route::get('/', function () {
//    return view('welcome');
//})->name('main');

Route::get('/', 'TestController@index')->name('main');

Route::get('/tests', 'TestsController@index')->name('test.index');

Route::get('/new', 'TestController@create')->name('test.create');
Route::post('/new', 'TestController@store')->name('test.store');


Route::get('/test/{test}', 'TestController@show')->name('test.show');
Route::get('/test/{test}/{question}', 'QuestionController@show')->name('question.show');
Route::get('/test/{test}/result', 'TestController@show')->name('test.result');


Route::get('/home', 'HomeController@index')->name('home');
