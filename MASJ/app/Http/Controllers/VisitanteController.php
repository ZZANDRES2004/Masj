<?php

namespace App\Http\Controllers;

use App\Models\Visitante;
use Illuminate\Http\Request;

class VisitanteController extends Controller
{
    public function index()
    {
        $visitantes = Visitante::all();
        return view('visitantes.index', compact('visitantes'));
    }

    public function create()
    {
        return view('visitantes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'NombresVisitante' => 'required|string|max:255',
            'ApellidosVisitante' => 'required|string|max:255',
            'TipoDocumento' => 'required|string|max:50',
            'NumDocumento' => 'required|string|max:50',
            'apartamento' => 'required|string|max:255',
            'hora_entrada' => 'nullable',
            'hora_salida' => 'nullable',
        ], [
            'required' => 'Completa los datos por favor.'
        ]);

        Visitante::create($request->all());
        return redirect()->route('visitantes.index')->with('success', 'Visitante registrado exitosamente');
    }

    public function edit($idVisitante)
    {
        $visitante = Visitante::findOrFail($idVisitante);
        return view('visitantes.edit', compact('visitante'));
    }

    public function update(Request $request, $idVisitante)
    {
        $request->validate([
            'NombresVisitante' => 'required|string|max:255',
            'ApellidosVisitante' => 'required|string|max:255',
            'TipoDocumento' => 'required|string|max:50',
            'NumDocumento' => 'required|string|max:50',
            'apartamento' => 'required|string|max:255',
            'hora_entrada' => 'nullable',
            'hora_salida' => 'nullable',
        ]);

        $visitante = Visitante::findOrFail($idVisitante);
        $visitante->update($request->all());

        return redirect()->route('visitantes.index')->with('success', 'Visitante actualizado.');
    }

    public function destroy($idVisitante)
    {
        $visitante = Visitante::findOrFail($idVisitante);
        $visitante->delete();
        return redirect()->route('visitantes.index')->with('success', 'Visitante eliminado.');
    }
}


