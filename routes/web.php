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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/forum','DiscussionController@index');

Route::get('/discussion/{id}','DiscussionController@show');

Route::post('/discussion/{parent_id}/{discussion_id}','ResponseController@create');

Route::get('/upvote/{id}','ResponseController@editUpvote');

Route::get('/downvote/{id}','ResponseController@editDownvote');

Route::post('/create','DiscussionController@create');
Route::get('/byCategory/{id}','DiscussionController@byCat');
