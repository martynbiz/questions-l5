<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// questions routes

// convenience routes
Route::get('/', 'QuestionsController@index');
Route::get('popular', 'QuestionsController@popular');
Route::get('unanswered', 'QuestionsController@unanswered');
Route::get('/{id}', 'QuestionsController@show')->where('id', '[0-9]+');
Route::get('/ask', 'QuestionsController@create');

// restful routes: index, show, create, store, edit, update, and destroy
Route::resource('questions', 'QuestionsController');


// answers routes

// restful routes: index, show, create, store, edit, update, and destroy
Route::resource('answers', 'AnswersController', ['only' => ['store', 'edit', 'update', 'destroy']]);


// tags routes

Route::get('tags', 'TagsController@index');
Route::get('tags/{id}/{slug?}', 'TagsController@show');


// manage authentication and registration of members

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);


// admin/...

Route::group(['prefix' => 'admin'], function() {
    Route::resource('questions', 'Admin\QuestionsController');
    Route::resource('tags', 'Admin\TagsController');
});


// account/...

Route::group(['prefix' => 'account'], function() {
    Route::resource('questions', 'Account\QuestionsController');
});