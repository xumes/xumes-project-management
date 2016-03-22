<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

// CLIENT
Route::get('client', 'ClientController@index');
Route::get('client/{id}', 'ClientController@show');
Route::post('client', 'ClientController@store');
Route::delete('client/{id}', 'ClientController@destroy');
Route::put('client/{id}', 'ClientController@update');

//PROJECT NOTE
Route::get('project/{id}/note', 'ProjectNoteController@index');
Route::get('project/{id}/note/{noteId}', 'ProjectNoteController@show');
Route::post('project/{id}/note/', 'ProjectNoteController@store');
Route::put('project/{id}/note/{noteId}', 'ProjectNoteController@update');
Route::delete('project/{id}/note/{noteId}', 'ProjectNoteController@destroy');

//PROJECT
Route::get('project', 'ProjectController@index');
Route::get('project/{id}', 'ProjectController@show');
Route::post('project', 'ProjectController@store');
Route::delete('project/{id}', 'ProjectController@destroy');
Route::put('project/{id}', 'ProjectController@update');



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});
