<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;

// Маршруты для аутентификации
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Защищенные маршруты (требуют аутентификации)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::get('/user/{id}', [AuthController::class, 'getUserById']);

    Route::get('/posts', [PostController::class, 'index']);
    Route::post('/posts', [PostController::class, 'store']); 
    Route::post('/posts/{post}/like', [PostController::class, 'like']); 
    Route::post('/posts/{post}/comment', [PostController::class, 'comment']); 
});
