<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicamentosController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\AuthController;

// RUTAS PÚBLICAS (Solo invitados: guest)
Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

});

// RUTAS PROTEGIDAS (Solo usuarios autenticados: auth)
Route::middleware('auth')->group(function () {

    // Cerrar sesión
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Módulos del sistema
    Route::resource('medicamentos', MedicamentosController::class);

    Route::resource('proveedores', ProveedorController::class);

    Route::resource('empleados', EmpleadoController::class);

    // Página principal
    Route::get('/', function () {
        return redirect()->route('dashboard');
    });

});
