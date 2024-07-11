<?php

use App\Http\Controllers\SessionController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});


Route::get('/register', [RegisterUserController::class, 'create']);
Route::post('/register', [RegisterUserController::class, 'store']);
Route::post('/fetch-cities', [RegisterUserController::class, 'fetchCities'])->name('fetch-cities');


Route::get('/session', [SessionController::class, 'create']);
Route::post('/session', [SessionController::class, 'store']);
Route::delete('/session', [SessionController::class, 'destroy']);

Route::get('/admin', [AdminController::class, 'create']);
Route::get('/fetch-hw', [AdminController::class, 'fetchHealthWorkers'])->name('fetch-hw');
Route::get('/fetch-patient', [AdminController::class, 'fetchPatients'])->name('fetch-patient');
Route::get('/fetch-apt', [AdminController::class, 'fetchAppointments'])->name('fetch-apt');
Route::get('/fetch-vax', [AdminController::class, 'fetchVaccinations'])->name('fetch-vax');

Route::delete('/delete-hw/{id}', [AdminController::class, 'deleteHW'])->name('health-workers.destroy');
Route::delete('/delete-patient/{id}', [AdminController::class, 'deletePatient'])->name('patients.destroy');