<?php
// Archivo: app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Queja;
use App\Models\Reserva;
use App\Models\Visitante;
use App\Models\Correspondencia;
use App\Models\Usuario;

class DashboardController extends Controller
{
    public function index()
    {
        // Obtener el usuario actual
        $usuario = Auth::user();
        
        // Contar las quejas activas del usuario
        $quejas = Queja::where('apartamento_id', $usuario->apartamento_id)
                      ->where('estado', 'activa')
                      ->count();
        
        // Contar las reservas activas
        $reservas = Reserva::where('apartamento_id', $usuario->apartamento_id)
                         ->where('estado', 'activa')
                         ->count();
        
        // Contar los visitantes de los últimos 30 días
        $visitantes = Visitante::where('apartamento_id', $usuario->apartamento_id)
                             ->whereDate('fecha_visita', '>=', now()->subDays(30))
                             ->count();
        
        // Contar la correspondencia de los últimos 3 meses
        $correspondencia = Correspondencia::where('apartamento_id', $usuario->apartamento_id)
                                       ->whereDate('fecha_recepcion', '>=', now()->subMonths(3))
                                       ->count();
        
        return view('dashboard', compact('usuario', 'quejas', 'reservas', 'visitantes', 'correspondencia'));
    }
}