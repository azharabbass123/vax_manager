<?php

use App\Http\Controllers\SessionController;
use App\Http\Controllers\RegisterUserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});


Route::get('/register', [RegisterUserController::class, 'create']);
Route::post('/register', [RegisterUserController::class, 'store']);
Route::post('/fetch-cities', [RegisterUserController::class, 'fetchCities'])->name('fetch-cities');


Route::get('/session', [SessionController::class, 'create']);
Route::post('/session', [SessionController::class, 'store']);