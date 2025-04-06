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
        
        // Intenta la autenticación con los campos correctos
        if (Auth::attempt([
            'CorreoElectronico' => $request->email,
            'password' => $request->password
        ])) {
            return redirect()->route('residente.dashboardR');
        } else {
            return redirect()->back()->with('error', 'Credenciales incorrectas');
        }
    }
    
    public function showLoginForm()
    {
        return view('Login');
    }
}