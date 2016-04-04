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

use Illuminate\Http\Response;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

Route::get('/', function () {
    return view('welcome');
});

Route::post('oauth/access_token', function() {
    return \Response::json(Authorizer::issueAccessToken());
});

Route::group(['middleware' => 'oauth'], function(){
    // CLIENT
    Route::resource('client', 'ClientController', ['except' => ['create', 'edit']]);

    //PROJECT
    Route::group(['middleware'=>'CheckProjectOwner'], function() {
        Route::resource('project', 'ProjectController', ['except' => ['create', 'edit']]);
    });


    Route::group(['prefix'=>'project'], function(){

        //PROJECT NOTE
        Route::get('{id}/note', 'ProjectNoteController@index');
        Route::get('{id}/note/{noteId}', 'ProjectNoteController@show');
        Route::post('{id}/note/', 'ProjectNoteController@store');
        Route::put('{id}/note/{noteId}', 'ProjectNoteController@update');
        Route::delete('{id}/note/{noteId}', 'ProjectNoteController@destroy');
    });

});



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
