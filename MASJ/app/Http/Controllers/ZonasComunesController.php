<?php

namespace App\Http\Controllers;

use App\Models\ZonaComun;
use App\Models\Reserva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ZonasComunesController extends Controller
{
    /**
     * Muestra un listado de las zonas comunes disponibles.
     */
    public function index()
    {
        $zonasComunes = ZonaComun::all();
        $usuario = Auth::user();
        $reservasActivas = Reserva::where('apartamento_id', $usuario->apartamento_id)
                                ->where('estado', 'activa')
                                ->get();
        
        return view('zonas-comunes.index', compact('zonasComunes', 'reservasActivas'));
    }

    /**
     * Muestra el formulario para crear una nueva reserva.
     */
    public function create()
    {
        $zonasComunes = ZonaComun::all();
        return view('zonas-comunes.create', compact('zonasComunes'));
    }

    /**
     * Almacena una nueva reserva en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'zona_comun_id' => 'required|exists:zonas_comunes,id',
            'fecha' => 'required|date|after_or_equal:today',
            'hora_inicio' => 'required',
            'hora_fin' => 'required|after:hora_inicio',
        ]);

        $usuario = Auth::user();
        
        // Verificar disponibilidad
        $reservasExistentes = Reserva::where('zona_comun_id', $request->zona_comun_id)
            ->where('fecha', $request->fecha)
            ->where(function($query) use ($request) {
                $query->whereBetween('hora_inicio', [$request->hora_inicio, $request->hora_fin])
                    ->orWhereBetween('hora_fin', [$request->hora_inicio, $request->hora_fin]);
            })->count();
            
        if ($reservasExistentes > 0) {
            return back()->with('error', 'El horario seleccionado no está disponible.');
        }
        
        Reserva::create([
            'zona_comun_id' => $request->zona_comun_id,
            'apartamento_id' => $usuario->apartamento_id,
            'usuario_id' => $usuario->idUsuario,
            'fecha' => $request->fecha,
            'hora_inicio' => $request->hora_inicio,
            'hora_fin' => $request->hora_fin,
            'estado' => 'activa'
        ]);

        return redirect()->route('zonas-comunes.index')
            ->with('success', 'Reserva creada exitosamente.');
    }

    /**
     * Muestra los detalles de una zona común específica.
     */
    public function show($id)
    {
        $zonaComun = ZonaComun::findOrFail($id);
        $reservas = Reserva::where('zona_comun_id', $id)
                         ->where('fecha', '>=', now()->format('Y-m-d'))
                         ->orderBy('fecha')
                         ->orderBy('hora_inicio')
                         ->get();
                         
        return view('zonas-comunes.show', compact('zonaComun', 'reservas'));
    }

    /**
     * Cancela una reserva existente.
     */
    public function cancelarReserva($id)
    {
        $reserva = Reserva::findOrFail($id);
        $usuario = Auth::user();
        
        // Verificar que la reserva pertenezca al usuario actual
        if ($reserva->apartamento_id != $usuario->apartamento_id) {
            return redirect()->route('zonas-comunes.index')
                ->with('error', 'No tiene permiso para cancelar esta reserva.');
        }
        
        $reserva->update(['estado' => 'cancelada']);
        
        return redirect()->route('zonas-comunes.index')
            ->with('success', 'Reserva cancelada exitosamente.');
    }
}
