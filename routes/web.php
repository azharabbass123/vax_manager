<?php

use App\Http\Controllers\SessionController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HealthWorkerController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ApointmentController;
use App\Http\Controllers\VaccinationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});


Route::get('/register', [RegisterUserController::class, 'create']);
Route::post('/register', [RegisterUserController::class, 'store']);
Route::get('/edit/{id}', [RegisterUserController::class, 'edit']);
Route::patch('/update/{id}', [RegisterUserController::class, 'update']);
Route::post('/fetch-cities', [RegisterUserController::class, 'fetchCities'])->name('fetch-cities');
Route::post('/fetch-avaialble-hw', [RegisterUserController::class, 'fetchHw'])->name('fetch-avaialble-hw');


Route::get('/session', [SessionController::class, 'create']);
Route::post('/session', [SessionController::class, 'store']);
Route::delete('/session', [SessionController::class, 'destroy']);

Route::get('/admin', [AdminController::class, 'create']);
Route::get('/fetch-hw', [AdminController::class, 'fetchHealthWorkers'])->name('fetch-hw');
Route::get('/fetch-patient', [AdminController::class, 'fetchPatients'])->name('fetch-patient');
Route::get('/fetch-apt', [AdminController::class, 'fetchAppointments'])->name('fetch-apt');
Route::get('/fetch-vax', [AdminController::class, 'fetchVaccinations'])->name('fetch-vax');
Route::get('/blocked-users', [AdminController::class, 'fetchBlockedUsers'])->name('blocked-users');
Route::get('/blockedUsers', [AdminController::class, 'showBlockedUsers']);

Route::delete('/delete-hw/{id}', [AdminController::class, 'deleteHW'])->name('health-workers.destroy');
Route::delete('/delete-patient/{id}', [AdminController::class, 'deletePatient'])->name('patients.destroy');

Route::patch('/unBlockUser/{id}', [AdminController::class, 'unBlockUser'])->name('unBlockUser');

Route::get('/health_worker', [HealthWorkerController::class, 'create']);
Route::get('/fetch-hw-apt', [HealthWorkerController::class, 'fetchAppointments'])->name('fetch-hw-apt');
Route::get('/fetch-hw-vax', [HealthWorkerController::class, 'fetchVaccinations'])->name('fetch-hw-vax');
Route::get('/track-patients', [HealthWorkerController::class, 'trackPatients'])->name('track-patients');

Route::get('/patient', [PatientController::class, 'create']);
Route::get('/fetch-patient-apt', [PatientController::class, 'fetchAppointments'])->name('fetch-patient-apt');
Route::get('/fetch-patient-vax', [PatientController::class, 'fetchVaccinations'])->name('fetch-patient-vax');

Route::get('/appointment', [ApointmentController::class, 'create']);
Route::post('/appointment', [ApointmentController::class, 'store']);
Route::get('/editAppointment/{id}', [ApointmentController::class, 'edit']);
Route::patch('/updateAppointment/{id}', [ApointmentController::class, 'update']);

Route::get('/vaccination',[VaccinationController::class, 'create']);
Route::post('/vaccination',[VaccinationController::class, 'store']);
Route::get('/editVaccination/{id}',[VaccinationController::class, 'edit']);
Route::patch('/updateVaccination/{id}',[VaccinationController::class, 'update']);
