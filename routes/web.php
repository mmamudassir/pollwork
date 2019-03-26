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

Route::get('/', ['uses' => 'MainController@getMain', 'as' => 'main']);
Route::get('/poll/{poll_id}', ['uses' => 'MainController@getMyPoll', 'as' => 'poll']);
Route::post('/vote', ['uses' => 'MainController@postMyVote', 'as' => 'poll.vote']);

Auth::routes();

Route::group([ 'prefix'=>'/admin', 'middleware' => 'auth' ], function(){
    Route::get('/poll/create', ['uses' => 'PollController@createPoll', 'as' => 'poll.create']);
    Route::post('/poll/create', ['uses' => 'PollController@savePoll', 'as' => 'poll.save']);

});

Route::get('/home', 'HomeController@index')->name('home');
