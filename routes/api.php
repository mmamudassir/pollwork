<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/*
 * public routes
 * */

/*
 * register login routes
 * */
Route::post('/register', ['uses' => 'Api\AuthController@register', 'as' => 'login.api']);
Route::post('/login', ['uses' => 'Api\AuthController@login', 'as' => 'login.api']);

/*
 * fetching all polls and casting vote
 * */
Route::post('/polls', ['uses' => 'Api\PollController@getPolls', 'as' => 'polls.api']);
Route::post('/vote', ['uses' => 'Api\PollController@postMyVote', 'as' => 'vote-poll.api']);

/*
 *  auth routes
 * */
Route::middleware('auth:api')->group(function () {
    Route::post('/logout', ['uses' => 'Api\AuthController@logout', 'as' => 'logout.api']);
});