<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormularioController;
use App\Http\Controllers\Admin\PacientesController;
use App\Http\Controllers\Auth\LoginController;

// Formulario público
Route::get('/', [FormularioController::class, 'index'])->name('formulario');
Route::post('/registro', [FormularioController::class, 'store'])->name('formulario.store');
Route::get('/especialistas', [FormularioController::class, 'especialistas'])->name('especialistas');
Route::get('/pago', fn() => view('pago'))->name('pago');

// Auth
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Panel admin (protegido)
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/pacientes', [PacientesController::class, 'index'])->name('pacientes');
    Route::get('/pacientes/{paciente}', [PacientesController::class, 'show'])->name('pacientes.show');
});
