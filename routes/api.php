<?php

use App\Http\Controllers\Filmes\FilmesController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Comments\CommentsController;
use App\Http\Controllers\Likes\LikesController;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register'])->withoutMiddleware('auth:sanctum');
    Route::post('login', [AuthController::class, 'login'])->withoutMiddleware('auth:sanctum');
    Route::post('logout', [AuthController::class, 'logout']);
    });

    Route::prefix('movie')->group(function () {
        Route::get('list', [FilmesController::class, 'ListMovie'])->withoutMiddleware('auth:sanctum');
        Route::get('{id}', [FilmesController::class, 'getMovieDetails'])->withoutMiddleware('auth:sanctum');
        Route::get('video/{id}', [FilmesController::class, 'getMovieVideos'])->withoutMiddleware('auth:sanctum');
    });

    Route::prefix('like')->group(function () {
        Route::post('create', [LikesController::class, 'like']);
        Route::get('list', [LikesController::class, 'listLikes']);
    });

    Route::prefix('commit')->group(function () {
        Route::post('create', [CommentsController::class, 'create']);
        Route::get('list', [CommentsController::class, 'listComments']);
    });
});
