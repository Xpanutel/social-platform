<?php

use Illuminate\Support\Facades\Route;

// Маршрут для главной страницы
Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');