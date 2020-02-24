<?php

use Illuminate\Http\Request;



//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('tests', 'TestController@index');
Route::get('test/{test}', 'TestController@show');
Route::post('/test/start/{test}/{version}', 'TestHistoryController@store');
Route::post('/test/end/{test}/{version}', 'TestHistoryController@update');
Route::post('/test/question/pass', 'QuestionAnswersHistoryController@store');

