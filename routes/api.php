<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\InitiativeController;

// Маршруты для аутентификации
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Публичные маршруты
Route::get('/initiatives', [InitiativeController::class, 'index']); 
Route::get('/initiatives/{id}', [InitiativeController::class, 'show']); 
Route::post('/initiatives/{id}/support', [InitiativeController::class, 'support']); 

// Защищенные маршруты (требуют аутентификации)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::get('/user/{id}', [AuthController::class, 'getUserById']);
    Route::get('/user/{id}/posts', [PostController::class, 'getUserPosts']);

    Route::get('/posts', [PostController::class, 'index']);
    Route::post('/posts', [PostController::class, 'store']); 
    Route::post('/posts/{post}/like', [PostController::class, 'like']); 
    Route::post('/posts/{post}/comment', [PostController::class, 'comment']); 

    Route::post('/initiatives', [InitiativeController::class, 'store']); 
});