<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller 
{
    use ValidatesRequests;
    
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        
        if (Auth::attempt([
            'CorreoElectronico' => $request->email,
            'password' => $request->password
        ])) {
            $usuario = Auth::user();

            switch ($usuario->Rol) {
                case 'propietario':
                    return redirect()->route('residente.dashboardR');
                case 'guardia':
                    return redirect()->route('guardia.dashboard');
                case 'administrador':
                    return redirect()->route('admin.dashboard');
                default:
                    Auth::logout();
                    return redirect()->route('Login.form')->with('error', 'Rol no reconocido');
            }
        } else {
            return redirect()->back()->with('error', 'Credenciales incorrectas');
        }
    }

    public function showLoginForm()
    {
        return view('Login'); // Asegúrate de tener esta vista creada
    }
} 