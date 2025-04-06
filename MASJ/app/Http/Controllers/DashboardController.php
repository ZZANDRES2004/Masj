<?php
// Archivo: app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use App\Models\Queja;
use App\Models\Reserva;
use App\Models\Visitante;
use App\Models\Correspondencia;
use Illuminate\Support\Facades\Auth;
class DashboardController extends Controller
{
    public function index()
    {
        $quejas = Queja::where('apartamento_id', Auth::user()->apartamento_id)->count();
        $reservas = Reserva::where('apartamento_id', Auth::user()->apartamento_id)->count();
        $visitantes = Visitante::where('apartamento_id', Auth::user()->apartamento_id)->count();
        $correspondencia = Correspondencia::where('apartamento_id', Auth::user()->apartamento_id)->count();
        
        return view('residente.dashboardR', compact('quejas', 'reservas', 'visitantes', 'correspondencia'));
    }
}