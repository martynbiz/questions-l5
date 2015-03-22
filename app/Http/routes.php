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

Route::resource('/', 'QuestionsController');

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