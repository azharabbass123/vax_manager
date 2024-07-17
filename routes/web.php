<?php

use App\Http\Controllers\SessionController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HealthWorkerController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ApointmentController;
use App\Http\Controllers\VaccinationController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\ValidUser;
use App\Http\Middleware\Admin;
use App\Http\Middleware\HealthWorker;
use App\Http\Middleware\Patient;

Route::get('/', function () {
    return view('home');
});


Route::get('/register', [RegisterUserController::class, 'create']);
Route::post('/register', [RegisterUserController::class, 'store']);
Route::get('/edit/{id}', [RegisterUserController::class, 'edit']);
Route::patch('/update/{id}', [RegisterUserController::class, 'update']);
Route::post('/fetch-cities', [RegisterUserController::class, 'fetchCities'])->name('fetch-cities');
Route::post('/fetch-avaialble-hw', [RegisterUserController::class, 'fetchHw'])->name('fetch-avaialble-hw');

Route::get('/session', [SessionController::class, 'create'])->name('session');
Route::post('/session', [SessionController::class, 'store']);
Route::delete('/session', [SessionController::class, 'destroy']);

Route::middleware(Admin::class)->group(function () {
    Route::get('/admin', [AdminController::class, 'create'])->name('admin');
    Route::get('/fetch-hw', [AdminController::class, 'fetchHealthWorkers'])->name('fetch-hw');
    Route::get('/fetch-patient', [AdminController::class, 'fetchPatients'])->name('fetch-patient');                               
    Route::get('/fetch-apt', [AdminController::class, 'fetchAppointments'])->name('fetch-apt');
    Route::get('/fetch-vax', [AdminController::class, 'fetchVaccinations'])->name('fetch-vax');
    Route::get('/blocked-users', [AdminController::class, 'fetchBlockedUsers'])->name('blocked-users');
    Route::get('/blockedUsers', [AdminController::class, 'showBlockedUsers']);
    Route::delete('/delete-hw/{id}', [AdminController::class, 'deleteHW'])->name('health-workers.destroy');
    Route::delete('/delete-patient/{id}', [AdminController::class, 'deletePatient'])->name('patients.destroy');
    Route::patch('/unBlockUser/{id}', [AdminController::class, 'unBlockUser'])->name('unBlockUser');
});

Route::middleware(HealthWorker::class)->group(function(){
    Route::get('/health_worker', [HealthWorkerController::class, 'create'])->name('health_worker');
    Route::get('/fetch-hw-apt', [HealthWorkerController::class, 'fetchAppointments'])->name('fetch-hw-apt');
    Route::get('/fetch-hw-vax', [HealthWorkerController::class, 'fetchVaccinations'])->name('fetch-hw-vax');
    Route::get('/track-patients', [HealthWorkerController::class, 'trackPatients'])->name('track-patients');
    Route::get('/editVaccination/{id}',[VaccinationController::class, 'edit']);
    Route::patch('/updateVaccination/{id}',[VaccinationController::class, 'update']);
    Route::get('/editAppointment/{id}', [ApointmentController::class, 'edit']);
    Route::patch('/updateAppointment/{id}', [ApointmentController::class, 'update']);

});

Route::middleware(Patient::class)->group(function(){
    Route::get('/patient', [PatientController::class, 'create'])->name('patient');
    Route::get('/fetch-patient-apt', [PatientController::class, 'fetchAppointments'])->name('fetch-patient-apt');
    Route::get('/fetch-patient-vax', [PatientController::class, 'fetchVaccinations'])->name('fetch-patient-vax');    
});

Route::middleware(ValidUser::class)->group(function(){

    Route::get('/appointment', [ApointmentController::class, 'create']);
    Route::post('/appointment', [ApointmentController::class, 'store']);
    Route::get('/vaccination',[VaccinationController::class, 'create']);
    Route::post('/vaccination',[VaccinationController::class, 'store']);
    
});