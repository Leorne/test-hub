<?php

Route::get('/{any}', 'SpaController@index')->where('any', '.*');
Auth::routes();


Route::get('/', 'TestController@index')->name('test');

Route::get('/tests', 'TestController@index')->name('test.index');

Route::get('/new', 'TestController@create')->name('test.create');
Route::post('/new', 'TestController@store')->name('test.store');
Route::get('/new/{test}', 'TestController@edit')->name('test.edit');
Route::post('/new/{test}', 'TestController@update')->name('test.update');

Route::get('/test/{test}', 'TestController@show')->name('test.show');
Route::get('/test/{test}/{question}', 'QuestionController@show')->name('question.show');
Route::get('/test/{test}/result', 'TestController@show')->name('test.result');


Route::get('/home', 'HomeController@index')->name('home');

Route::get('/catalog/tags.json', 'TagController@index');
