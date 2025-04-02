<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistroController;

// Ruta para mostrar el formulario de registro (si es necesario, si no, puedes quitarla si '/' ya lo hace)
Route::get('/registro', function () {
     return view('registro');
 })->name('registro.form'); // Nombre diferente para GET

// Ruta para procesar el formulario de registro (esta ya la tenías bien)
Route::post('/registro', [RegistroController::class, 'store'])->name('registro'); // Mantenido

// Ruta para MOSTRAR el formulario de login
// Usa 'login' (minúscula) para el método si así se llama en tu controlador, o crea 'showLoginForm'
// Asumiré que quieres usar el método 'Login' que definiste en la ruta original, pero debe existir en el Controller.
// O más comúnmente:
Route::get('/Login', [LoginController::class, 'showLoginForm'])->name('Login.form'); // Ruta GET para mostrar

// Ruta para PROCESAR el formulario de login
Route::post('/Login', [LoginController::class, 'Login'])->name('Login.attempt'); // Ruta POST para procesar

// Ruta raíz (opcional, si quieres que vaya a registro o login por defecto)
Route::get('/', function () {
     // Puedes redirigir a la que prefieras o mostrar una vista
     return redirect()->route('Login.form');
     // o return view('welcome');
});

// Debes tener una ruta 'home' a la que redirige el login exitoso
Route::get('/home', function() {
    return 'Bienvenido - Sesión Iniciada'; // Vista de bienvenida simple
})->name('home')->middleware('auth'); // Asegura que solo usuarios autenticados entren