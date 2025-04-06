<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
class LoginController extends Controller
{
    use ValidatesRequests;
    public function login(Request $request){
        $this->validate($request, [
            'CorreoElectronico' => 'required|email', // Cambiar 'email' a 'CorreoElectronico'
            'password' => 'required'
        ]);
        $credentials = $request->only('CorreoElectronico', 'password'); // Cambiar 'email' a 'CorreoElectronico'
        if (\Illuminate\Support\Facades\Auth::attempt($credentials)) {
            return redirect()->intended('home');
        } else {
            return redirect()->back()->with('error', 'Credenciales incorrectas');
        }
    }
    public function showLoginForm()
    {
        return view('Login');
    }
}