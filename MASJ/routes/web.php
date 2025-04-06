<?php
// Archivo: routes/web.php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistroController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CustomPasswordResetController;

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

Route::get('/', function () {
    return redirect()->route('Login.form');
});


Route::get('/residente/dashboard', function () {
    return view('residente.dashboardR');
})->name('residente.dashboardR');


Auth::routes(['register' => false, 'reset' => false]); 