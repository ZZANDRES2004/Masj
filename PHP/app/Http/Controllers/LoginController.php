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
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $credentials = $request->only('email', 'password');
        if (\Illuminate\Support\Facades\Auth::attempt($credentials)) {
            return redirect()->intended('home');
        } else {
            return redirect()->back()->with('error', 'Credenciales incorrectas');
        }
    }
    public function showLoginForm()
    {
        return view('Login'); // Asegúrate que la vista se llame 'login.blade.php'
    }
}
