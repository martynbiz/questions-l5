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
Route::get('/{id}', 'QuestionsController@show')->where('id', '[0-9]+');
Route::get('/ask', 'QuestionsController@create');
Route::get('popular', 'QuestionsController@popular');
Route::get('unanswered', 'QuestionsController@unanswered');

// restful routes: index, show, create, store, edit, update, and destroy
Route::resource('questions', 'QuestionsController');


// manage authentication and registration of members

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);


// admin/...

Route::group(['prefix' => 'admin'], function() {
    Route::resource('questions', 'Admin\QuestionsController');
});


// account/...

Route::group(['prefix' => 'account'], function() {
    Route::resource('questions', 'Account\QuestionsController');
});