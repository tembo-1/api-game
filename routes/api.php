<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\GameController;
use App\Http\Controllers\Api\StudioController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\GameCategoryController;
use App\Http\Controllers\Api\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::group(['middleware' => 'throttle:3,60'], function() {
    Route::post('/login', [AuthController::class, 'login']);
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::apiResource('/games',            GameController::class);
    Route::apiResource('/studios',          StudioController::class);
    Route::apiResource('/categories',       CategoryController::class);
    Route::apiResource('/gamecategories',   GameCategoryController::class);


    Route::get('/games/getByCategoryId/{category_id}',  [GameController::class,     'getByCategoryId']);
    Route::get('/games/getByCategoryName/{name}',       [GameController::class,     'getByCategoryName']);
});

