<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;
use Carbon\Carbon;
use App\Mail\ResetPasswordMail;

class CustomPasswordResetController extends Controller
{
    // Vista para solicitar reinicio de contraseña
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'CorreoElectronico' => 'required|email|exists:usuario,CorreoElectronico',
        ], [
            'CorreoElectronico.exists' => 'No encontramos una cuenta con ese correo electrónico.'
        ]);
        
        // Generar token
        $token = Str::random(64);
        $email = $request->CorreoElectronico;
        
        // Guardar en la tabla de reinicio de contraseñas
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $email],
            [
                'email' => $email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]
        );
        
        // Enviar correo
        Mail::to($email)->send(new ResetPasswordMail($token, $email));
        
        return back()->with('status', 'Hemos enviado un correo para restablecer tu contraseña.');
    }
    // Vista para crear nueva contraseña
    public function showForgotForm()
    {
        return view('auth.forgot-password');
    }

    // Procesar cambio de contraseña
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:usuario,CorreoElectronico',
            'password' => 'required|string|min:8|confirmed',
            'token' => 'required'
        ]);

        // Verificar token válido
        $passwordReset = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$passwordReset) {
            return back()->withErrors(['email' => 'Token inválido o expirado.']);
        }

        // Verificar si el token ha expirado (24 horas)
        $createdAt = Carbon::parse($passwordReset->created_at);
        if (Carbon::now()->diffInHours($createdAt) > 24) {
            DB::table('password_reset_tokens')->where('email', $request->email)->delete();
            return back()->withErrors(['email' => 'El enlace ha expirado. Por favor solicita uno nuevo.']);
        }

        // Actualizar contraseña
        $user = Usuario::where('CorreoElectronico', $request->email)->first();
        $user->Contrasena = Hash::make($request->password);
        $user->save();

        // Eliminar token usado
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('Login.form')->with('status', 'Tu contraseña ha sido actualizada correctamente.');
    }
}