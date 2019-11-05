<?php

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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->namespace('Api\v1')->group(function () {
    Route::get('/courses', 'CourseController@index');
    Route::get('/courses/{course}', 'CourseController@single');
    Route::post('/courses', 'CourseController@store');

    Route::post('login', 'UserController@login');
    Route::post('register', 'UserController@register');

    Route::middleware('auth:api')->group(function () {
        Route::get('/user', function () {
            return \auth()->user();
        });

        Route::post('/comment', 'CommentController@store');
        Route::post('/upload/image', 'UploadController@image');
        Route::post('/upload/file', 'UploadController@file');


    });


});

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::prefix('v2')->namespace('Api\v2')->group(function () {
    Route::get('/courses', 'CourseController@index');
    Route::get('/courses/{course}', 'CourseController@single');
    Route::post('/courses', 'CourseController@store');

    Route::post('login', 'UserController@login');
    Route::post('register', 'UserController@register');

    Route::middleware('auth:api')->group(function () {
        Route::get('/user', function () {
            return \auth()->user();
        });

        Route::post('/comment', 'CommentController@store');
        Route::post('/upload/image', 'UploadController@image');
        Route::post('/upload/file', 'UploadController@file');
        Route::middleware('auth:api')->group(function () {
            Route::post('/courses/buy/{course}', 'BuyController@buy');

        });

    });
});
