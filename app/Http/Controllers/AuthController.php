<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //mostrar inicio de sesion
    public function showLogin()
    {
        if (Auth::check()) {
            if (Auth::user()->cambiar_password) {
                return redirect()->route('password.change');
            }

            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }

    // el incio de sesion
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|ends_with:@disfarma.hn',
            'password' => 'required|string',
        ]);

        $credenciales = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credenciales, $request->boolean('remember'))) {
            $request->session()->regenerate();

            if (Auth::user()->cambiar_password) {
                return redirect()->route('password.change');
            }

            return redirect()->intended(route('dashboard'))
                             ->with('success', '¡Bienvenido a DISFARMA!');
        }

        return back()->withErrors([
            'email' => 'Los datos son incorrectos',
        ])->onlyInput('email');
    }

    //cambiar la contraseña para usuarios nuevos pero mostrar el panel
    public function showChangePassword()
    {
        return view('auth.change-password');
    }

    //ahora si cambiarla
    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $usuario = Auth::user();

        $usuario->password = $request->password;
        $usuario->cambiar_password = false;
        $usuario->save();

        return redirect()->route('dashboard')
                         ->with('success', '¡Contraseña actualizada correctamente!');
    }
    
    //cirre de sesion
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
                         ->with('success', 'Has cerrado sesión correctamente.');
    }
}
