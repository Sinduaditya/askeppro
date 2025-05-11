<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AskepCaseController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuideController;

// Route halaman utama
Route::get('/', function () {
    return redirect()->route('login');
});

// Route autentikasi
Route::get('/login', [AuthController::class, 'showLoginForm'])
    ->name('login')
    ->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Pasien
    Route::resource('patients', PatientController::class);
    Route::get('/patients/{patient}/history', [PatientController::class, 'history'])->name('patients.history');

    // ASKep Flow
    Route::get('/askep/{patient}/create', [AskepCaseController::class, 'create'])->name('askep.create');
    Route::post('/askep/store-symptoms', [AskepCaseController::class, 'storeSymptoms'])->name('askep.storeSymptoms');

    // Diagnosis
    Route::get('/askep/{case}/diagnosis', [AskepCaseController::class, 'showDiagnosis'])->name('askep.diagnosis');
    Route::post('/askep/{case}/diagnosis', [AskepCaseController::class, 'saveDiagnosis'])->name('askep.saveDiagnosis');

    // Outcome
    Route::get('/askep/{case}/outcome', [AskepCaseController::class, 'showOutcome'])->name('askep.outcome');
    Route::post('/askep/{case}/outcome', [AskepCaseController::class, 'saveOutcome'])->name('askep.saveOutcome');

    // Intervention
    Route::get('/askep/{case}/intervention', [AskepCaseController::class, 'showIntervention'])->name('askep.intervention');
    Route::post('/askep/{case}/intervention', [AskepCaseController::class, 'saveIntervention'])->name('askep.saveIntervention');

    // Implementation
    Route::get('/askep/{case}/implementation', [AskepCaseController::class, 'showImplementation'])->name('askep.implementation');
    Route::post('/askep/{case}/implementation', [AskepCaseController::class, 'saveImplementation'])->name('askep.saveImplementation');

    // Evaluation
    Route::get('/askep/{case}/evaluation', [AskepCaseController::class, 'showEvaluation'])->name('askep.evaluation');
    Route::post('/askep/{case}/evaluation', [AskepCaseController::class, 'saveEvaluation'])->name('askep.saveEvaluation');

    Route::get('/askep/{case}/print', [AskepCaseController::class, 'printReport'])->name('askep.print');

    // Tambahkan route ini di grup middleware auth
    Route::get('/askep/{id}/report-data', [App\Http\Controllers\AskepCaseController::class, 'getReportData'])
        ->middleware('auth')
        ->name('askep.report-data');

    // Panduan
    Route::get('/guide', [GuideController::class, 'index'])->name('guide.index');
});
