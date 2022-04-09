<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\VideosController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => 'api'], function () {

    Route::group(["prefix" => "auth"], function(){
        Route::post('sign-in',  [AuthController::class, 'login']);
        Route::post('sign-out', [AuthController::class, 'logout']);
        Route::post('refresh',  [AuthController::class, 'refresh']);
        Route::get( 'me',       [AuthController::class, 'me']);
    });

    Route::group(["middleware" => "auth"], function(){
        Route::apiResources([
            "users"  => UsersController::class,
            "posts"  => PostsController::class,
            "videos" => VideosController::class
        ]);
    });
});