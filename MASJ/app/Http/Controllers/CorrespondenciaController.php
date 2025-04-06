<?php

namespace App\Http\Controllers;

use App\Models\Correspondencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CorrespondenciaController extends Controller
{
    /**
     * Muestra un listado de la correspondencia.
     */
    public function index()
    {
        $usuario = Auth::user();
        $correspondencia = Correspondencia::where('apartamento_id', $usuario->apartamento_id)
                                       ->orderBy('fecha_recepcion', 'desc')
                                       ->get();
        
        return view('correspondencia.index', compact('correspondencia'));
    }

    /**
     * Muestra los detalles de una correspondencia específica.
     */
    public function show(Correspondencia $correspondencia)
    {
        // Verificar que la correspondencia pertenezca al usuario actual
        $usuario = Auth::user();
        if ($correspondencia->apartamento_id != $usuario->apartamento_id) {
            return redirect()->route('correspondencia.index')
                ->with('error', 'No tiene permiso para ver esta correspondencia.');
        }
        
        return view('correspondencia.show', compact('correspondencia'));
    }

    /**
     * Marca una correspondencia como recogida.
     */
    public function marcarRecogida(Correspondencia $correspondencia)
    {
        // Verificar que la correspondencia pertenezca al usuario actual
        $usuario = Auth::user();
        if ($correspondencia->apartamento_id != $usuario->apartamento_id) {
            return redirect()->route('correspondencia.index')
                ->with('error', 'No tiene permiso para actualizar esta correspondencia.');
        }
        
        $correspondencia->update([
            'estado' => 'recogida',
            'fecha_recogida' => now(),
            'usuario_recogida_id' => $usuario->idUsuario
        ]);

        return redirect()->route('correspondencia.index')
            ->with('success', 'Correspondencia marcada como recogida exitosamente.');
    }

    /**
     * Muestra el historial de correspondencia.
     */
    public function historial()
    {
        $usuario = Auth::user();
        $correspondencia = Correspondencia::where('apartamento_id', $usuario->apartamento_id)
                                       ->orderBy('fecha_recepcion', 'desc')
                                       ->paginate(15);
        
        return view('correspondencia.historial', compact('correspondencia'));
    }
}
