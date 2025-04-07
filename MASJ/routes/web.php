<?php
// Archivo: routes/web.php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistroController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CustomPasswordResetController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\QuejasController;
use App\Http\Controllers\ZonasComunesController;
use App\Http\Controllers\CorrespondenciaController; 
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\PaqueteriaController;
use App\Http\Controllers\VisitanteController;

Route::get('/registro', function () {
    return view('registro');
})->name('registro.form');

Route::post('/registro', [RegistroController::class, 'store'])->name('registro');

Route::get('/Login', [LoginController::class, 'showLoginForm'])->name('Login.form');
Route::post('/Login', [LoginController::class, 'Login'])->name('Login.attempt');

// Rutas para restablecimiento de contraseña
Route::get('/forgot-password', [CustomPasswordResetController::class, 'showForgotForm'])
    ->name('password.request');
Route::post('/forgot-password', [CustomPasswordResetController::class, 'sendResetLink'])
    ->name('password.email');
Route::get('/reset-password/{token}', [CustomPasswordResetController::class, 'showResetForm'])
    ->name('password.reset');
Route::post('/reset-password', [CustomPasswordResetController::class, 'resetPassword'])
    ->name('password.update');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::get('/', function () {
    return redirect()->route('Login.form');
});

Route::get('/residente/dashboardR', function () {
    return view('residente.dashboardR');
})->name('residente.dashboardR');

Route::get('/dashboardR', [DashboardController::class, 'dashboardR'])->middleware(['auth'])->name('dashboardR');

Route::get('/zonas-comunes', [ZonasComunesController::class, 'zonasComunes'])->middleware(['auth'])->name('zonas-comunes');
Route::get('/visitantes', [VisitanteController::class, 'index'])->middleware(['auth'])->name('visitantes.index');
Route::get('/correspondencia', [CorrespondenciaController::class, 'correspondencia'])->middleware(['auth'])->name('correspondencia');

Route::middleware(['auth'])->group(function () {
    Route::get('/quejas', [QuejasController::class, 'index'])->name('quejas.index');
    Route::post('/quejas', [QuejasController::class, 'store'])->name('quejas.store');
});

Auth::routes(['register' => false, 'reset' => false]); 
Route::resource('vehiculos', VehiculoController::class);
Route::resource('paqueterias', PaqueteriaController::class);
// Route::resource('visitantes', VisitantesController::class);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// ✅ Ruta para el dashboard del guardia
Route::get('/guardia/dashboard', function () {
    return view('guardia.dashboard');
})->middleware(['auth'])->name('guardia.dashboard');
