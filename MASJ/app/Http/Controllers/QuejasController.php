<?php

namespace App\Http\Controllers;

use App\Models\Queja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuejasController extends Controller
{
    /**
     * Muestra un listado de las quejas.
     */
    public function index()
    {
        return view('residente.quejas');
    }

    /**
     * Muestra el formulario para crear una nueva queja.
     */
    public function create()
    {
        return view('quejas.create');
    }

    /**
     * Almacena una nueva queja en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'tipo' => 'required'
        ]);

        $usuario = Auth::user();
        
        Queja::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'tipo' => $request->tipo,
            'estado' => 'activa',
            'apartamento_id' => $usuario->apartamento_id,
            'usuario_id' => $usuario->idUsuario
        ]);

        return redirect()->route('quejas.index')
            ->with('success', 'Queja registrada exitosamente.');
    }

    /**
     * Muestra los detalles de una queja específica.
     */
    public function show(Queja $queja)
    {
        // Verificar que la queja pertenezca al usuario actual
        $usuario = Auth::user();
        if ($queja->apartamento_id != $usuario->apartamento_id) {
            return redirect()->route('quejas.index')
                ->with('error', 'No tiene permiso para ver esta queja.');
        }
        
        return view('quejas.show', compact('queja'));
    }

    /**
     * Muestra el formulario para editar una queja existente.
     */
    public function edit(Queja $queja)
    {
        // Verificar que la queja pertenezca al usuario actual
        $usuario = Auth::user();
        if ($queja->apartamento_id != $usuario->apartamento_id) {
            return redirect()->route('quejas.index')
                ->with('error', 'No tiene permiso para editar esta queja.');
        }
        
        return view('quejas.edit', compact('queja'));
    }

    /**
     * Actualiza una queja específica en la base de datos.
     */
    public function update(Request $request, Queja $queja)
    {
        // Verificar que la queja pertenezca al usuario actual
        $usuario = Auth::user();
        if ($queja->apartamento_id != $usuario->apartamento_id) {
            return redirect()->route('quejas.index')
                ->with('error', 'No tiene permiso para actualizar esta queja.');
        }
        
        $request->validate([
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'tipo' => 'required'
        ]);

        $queja->update($request->all());

        return redirect()->route('quejas.index')
            ->with('success', 'Queja actualizada exitosamente.');
    }

    /**
     * Elimina una queja específica de la base de datos.
     */
    public function destroy(Queja $queja)
    {
        // Verificar que la queja pertenezca al usuario actual
        $usuario = Auth::user();
        if ($queja->apartamento_id != $usuario->apartamento_id) {
            return redirect()->route('quejas.index')
                ->with('error', 'No tiene permiso para eliminar esta queja.');
        }
        
        $queja->delete();

        return redirect()->route('quejas.index')
            ->with('success', 'Queja eliminada exitosamente.');
    }
}
