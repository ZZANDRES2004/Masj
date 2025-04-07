<?php

namespace App\Http\Controllers;

use App\Models\Visitante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisitantesController extends Controller
{
    /**
     * Muestra un listado de los visitantes.
     */
    public function index()
    {
        $usuario = Auth::user();
        $visitantes = Visitante::where('apartamento_id', $usuario->apartamento_id)
                             ->orderBy('fecha_visita', 'desc')
                             ->get();
        
        return view('visitantes.index', compact('visitantes'));
    }

    /**
     * Muestra el formulario para registrar un nuevo visitante.
     */
    public function create()
    {
        return view('visitantes.create');
    }

    /**
     * Almacena un nuevo visitante en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:255',
            'tipo_documento' => 'required',
            'numero_documento' => 'required|max:20',
            'fecha_visita' => 'required|date|after_or_equal:today',
            'hora_visita' => 'required',
        ]);

        $usuario = Auth::user();
        
        Visitante::create([
            'nombre' => $request->nombre,
            'tipo_documento' => $request->tipo_documento,
            'numero_documento' => $request->numero_documento,
            'fecha_visita' => $request->fecha_visita,
            'hora_visita' => $request->hora_visita,
            'apartamento_id' => $usuario->apartamento_id,
            'usuario_id' => $usuario->idUsuario,
            'estado' => 'pendiente'
        ]);

        return redirect()->route('visitantes.index')
            ->with('success', 'Visitante registrado exitosamente.');
    }

    /**
     * Muestra los detalles de un visitante específico.
     */
    public function show(Visitante $visitante)
    {
        // Verificar que el visitante pertenezca al usuario actual
        $usuario = Auth::user();
        if ($visitante->apartamento_id != $usuario->apartamento_id) {
            return redirect()->route('visitantes.index')
                ->with('error', 'No tiene permiso para ver este visitante.');
        }
        
        return view('visitantes.show', compact('visitante'));
    }

    /**
     * Muestra el formulario para editar un visitante existente.
     */
    public function edit(Visitante $visitante)
    {
        // Verificar que el visitante pertenezca al usuario actual
        $usuario = Auth::user();
        if ($visitante->apartamento_id != $usuario->apartamento_id) {
            return redirect()->route('visitantes.index')
                ->with('error', 'No tiene permiso para editar este visitante.');
        }
        
        return view('visitantes.edit', compact('visitante'));
    }

    /**
     * Actualiza un visitante específico en la base de datos.
     */
    public function update(Request $request, Visitante $visitante)
    {
        // Verificar que el visitante pertenezca al usuario actual
        $usuario = Auth::user();
        if ($visitante->apartamento_id != $usuario->apartamento_id) {
            return redirect()->route('visitantes.index')
                ->with('error', 'No tiene permiso para actualizar este visitante.');
        }
        
        $request->validate([
            'nombre' => 'required|max:255',
            'tipo_documento' => 'required',
            'numero_documento' => 'required|max:20',
            'fecha_visita' => 'required|date',
            'hora_visita' => 'required',
        ]);

        $visitante->update($request->all());

        return redirect()->route('visitantes.index')
            ->with('success', 'Información del visitante actualizada exitosamente.');
    }

    /**
     * Cancela la visita de un visitante específico.
     */
    public function destroy(Visitante $visitante)
    {
        // Verificar que el visitante pertenezca al usuario actual
        $usuario = Auth::user();
        if ($visitante->apartamento_id != $usuario->apartamento_id) {
            return redirect()->route('visitantes.index')
                ->with('error', 'No tiene permiso para cancelar esta visita.');
        }
        
        $visitante->update(['estado' => 'cancelado']);

        return redirect()->route('visitantes.index')
            ->with('success', 'Visita cancelada exitosamente.');
    }
}
