<?php

use App\Http\Controllers\Acao\AcaoController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Filmes\FilmesController;
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
    Route::prefix('Filmes')->group(function () {
        Route::get('List', [FilmesController::class, 'ListMovie'])->withoutMiddleware('auth:sanctum');
        Route::get('{id}', [FilmesController::class, 'getMovieDetails'])->withoutMiddleware('auth:sanctum');
    });
    Route::prefix('action')->group(function () {
        Route::get('list', [AcaoController::class, 'AcaoController'])->withoutMiddleware('auth:sanctum');
        Route::get('like', [AcaoController::class, 'AcaoController'])->withoutMiddleware('auth:sanctum');
        Route::get('comment', [AcaoController::class, 'getMovieDetails'])->withoutMiddleware('auth:sanctum');
    });
});
