<?php

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

    $usuario = Auth::user();
    $quejas = Queja::where('idResidente', $usuario->idResidente)->count();
    $reservas = Reserva::where('apartamento_id', $usuario->apartamento_id)->count();
    $visitantes = Visitante::where('apartamento_id', $usuario->apartamento_id)->count();
    $correspondencia = Correspondencia::where('apartamento_id', $usuario->apartamento_id)->count();
    
    return view('residente.dashboardR', compact('quejas', 'reservas', 'visitantes', 'correspondencia'));
}
}