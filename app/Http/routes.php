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
Route::get('following', 'QuestionsController@following');
Route::get('/{id}/{slug?}', 'QuestionsController@show')->where('id', '[0-9]+');
Route::get('/ask', 'QuestionsController@create');

// restful routes: index, show, create, store, edit, update, and destroy
Route::resource('questions', 'QuestionsController');


// answers routes

// restful routes: index, show, create, store, edit, update, and destroy
Route::resource('answers', 'AnswersController');


// tags routes

Route::get('tags', 'TagsController@index');
Route::get('tags/{id}/{slug?}', 'TagsController@show')->where('id', '[0-9]+');


// manage authentication and registration of members

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);


// admin/...

Route::group(['prefix' => 'admin', 'middleware' => 'auth.admin'], function() {
    
    // admin/
    Route::resource('/', 'Admin\IndexController');
    
    // admin/questions
    Route::get('questions/approve', [
        'uses' => 'Admin\QuestionsController@approve',
        'as' => 'admin.questions.approve',
    ]);
    Route::resource('questions', 'Admin\QuestionsController');
    
    // admin/tags
    Route::resource('tags', 'Admin\TagsController');
    
    // admin/users
    Route::resource('users', 'Admin\UsersController');
    
    // admin/answers
    Route::resource('answers', 'Admin\AnswersController');
});


// account/...

Route::group(['prefix' => 'account', 'middleware' => 'auth'], function() {
    Route::resource('/', 'Account\IndexController');
    Route::resource('questions', 'Account\QuestionsController');
    // Route::resource('answers', 'Account\AnswersController');
});