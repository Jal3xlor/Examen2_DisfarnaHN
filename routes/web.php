<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicamentosController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;

// RUTAS PÚBLICAS
Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

});

// RUTAS PROTEGIDAS
Route::middleware('auth')->group(function () {

    //pa cerrar sesion
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

     //cambiar la passwor
    Route::get('/cambiar-password', [AuthController::class, 'showChangePassword'])->name('password.change');
    Route::post('/cambiar-password', [AuthController::class, 'updatePassword'])->name('password.update');

    //el dashboard
    Route::get('/dashboard', function () {
        if (Auth::user()->cambiar_password) {
            return redirect()->route('password.change');
        }
        return view('dashboard');
    })->name('dashboard');

    //los modulos
    Route::resource('medicamentos', MedicamentosController::class);

    Route::resource('proveedores', ProveedorController::class);

    Route::resource('empleados', EmpleadoController::class);

    //Página principal osea el dashboard xd
    Route::get('/', function () {
        return redirect()->route('dashboard');
    });

});
