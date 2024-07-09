<?php

use App\Http\Controllers\SessionController;
use App\Http\Controllers\RegisterUserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});


Route::get('/register', [RegisterUserController::class, 'create']);
Route::post('/register', [RegisterUserController::class, 'store']);

Route::get('/session', [SessionController::class, 'create']);
Route::post('/session', [SessionController::class, 'store']);