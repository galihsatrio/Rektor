<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MAgendaController;
use App\Http\Controllers\DAgendaController;
use App\Http\Controllers\MDosenController;
use App\Http\Controllers\MMahasiswaController;
use App\Http\Controllers\RescheduleController;

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate']);
});

// Admin
Route::group(['middleware' => ['auth', 'checkRole:admin']], function () {
    // Agenda
    Route::get('/agenda', [MAgendaController::class, 'index']);
    Route::get('/agenda/create', [MAgendaController::class, 'create']);
    Route::post('/agenda/simpan', [MAgendaController::class, 'simpan']);
    Route::get('/agenda/edit/{id}', [MAgendaController::class, 'edit']);
    Route::post('/agenda/update/{id}', [MAgendaController::class, 'update']);
    Route::delete('/agenda/delete/{id}', [MAgendaController::class, 'delete']);

    // Reschedule
    Route::get('/reschedule', [RescheduleController::class, 'index']);
    Route::post('/reschedule/{id}/{status}/{agenda_id}', [RescheduleController::class, 'approval']);

    // master pengguna
    Route::get('/pengguna', [AuthController::class, 'index']);
    Route::get('/pengguna/create', [AuthController::class, 'create']);
    Route::post('/pengguna/save', [AuthController::class, 'simpan']);
    Route::get('/pengguna/edit/{id}', [AuthController::class, 'edit']);
    Route::post('/pengguna/update/{id}', [AuthController::class, 'update']);
    Route::delete('/pengguna/delete/{id}', [AuthController::class, 'delete']);
});

// Rektor
Route::group(['middleware' => ['auth', 'checkRole:rektor']], function () {
    // Daftar Agenda
    Route::get('/daftar-agenda', [DAgendaController::class, 'index']);
    Route::get('/daftar-agenda/detail/{id}', [DAgendaController::class, 'detail']);
    Route::post('/daftar-agenda/persetujuan/{id}/{status}', [DAgendaController::class, 'persetujuan']);
    Route::post('/daftar-agenda/reschedule/{id}', [DAgendaController::class, 'reschedule']);
});

//Dua

Route::group(['middleware' => ['auth', 'checkRole:admin,rektor']], function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // dosen
    Route::get('/dosen', [MDosenController::class, 'index']);
    Route::get('/dosen/create', [MDosenController::class, 'create']);
    Route::post('/dosen/simpan', [MDosenController::class, 'simpan']);
    Route::get('/dosen/edit/{id}', [MDosenController::class, 'edit']);
    Route::post('/dosen/update/{id}', [MDosenController::class, 'update']);
    Route::delete('/dosen/delete/{id}', [MDosenController::class, 'delete']);

    // master mahasiswa
    Route::get('/mahasiswa', [MMahasiswaController::class, 'index']);
    Route::get('/mahasiswa/create', [MMahasiswaController::class, 'create']);
    Route::post('/mahasiswa/simpan', [MMahasiswaController::class, 'simpan']);
    Route::get('/mahasiswa/edit/{id}', [MMahasiswaController::class, 'edit']);
    Route::post('/mahasiswa/update/{id}', [MMahasiswaController::class, 'update']);
    Route::delete('/mahasiswa/delete/{id}', [MMahasiswaController::class, 'delete']);

    // Auth
    Route::post('/logout', [AuthController::class, 'logout']);
});
