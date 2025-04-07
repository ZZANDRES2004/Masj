<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Mail\ResetPasswordMail;
use App\Models\Usuario;

class CustomPasswordResetController extends Controller
{
    public function showForgotForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'CorreoElectronico' => 'required|email|exists:usuario,CorreoElectronico',
        ], [
            'CorreoElectronico.exists' => 'No encontramos una cuenta con ese correo electrónico.'
        ]);

        $token = Str::random(64);
        $email = $request->CorreoElectronico;

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $email],
            ['token' => $token, 'created_at' => Carbon::now()]
        );

        Mail::to($email)->send(new ResetPasswordMail($token, $email));

        return back()->with('status', 'Hemos enviado un correo para restablecer tu contraseña.');
    }

    public function showResetForm($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:usuario,CorreoElectronico',
            'password' => 'required|string|min:8|confirmed',
            'token' => 'required'
        ]);

        $record = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$record) {
            return back()->withErrors(['email' => 'Token inválido o expirado.']);
        }

        if (Carbon::now()->diffInHours(Carbon::parse($record->created_at)) > 24) {
            DB::table('password_reset_tokens')->where('email', $request->email)->delete();
            return back()->withErrors(['email' => 'El enlace ha expirado.']);
        }

        $user = Usuario::where('CorreoElectronico', $request->email)->first();
        $user->Contrasena = Hash::make($request->password);
        $user->save();

        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('Login.form')->with('status', 'Tu contraseña ha sido restablecida.');
    }
}
