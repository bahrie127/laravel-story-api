<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//register route
Route::post('/register', [\App\Http\Controllers\Api\AuthController::class, 'register']);
//login route
Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);

//protected route
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', function (Request $request) {
        return $request->user();
    });
    //logout route
    Route::post('/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);
    //my stories
    Route::get('/my-stories', [\App\Http\Controllers\Api\StoryController::class, 'myStories']);
    //store story
    Route::post('/stories', [\App\Http\Controllers\Api\StoryController::class, 'store']);
    //update story
    Route::put('/stories/{story}', [\App\Http\Controllers\Api\StoryController::class, 'update']);
    //delete story
    Route::delete('/stories/{story}', [\App\Http\Controllers\Api\StoryController::class, 'destroy']);
});
