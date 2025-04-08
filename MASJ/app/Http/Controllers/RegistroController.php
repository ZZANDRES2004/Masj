<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;

class RegistroController extends Controller
{
    public function store(Request $request)
    {

        $validated = $request->validate([
            'PrimerNombre' => 'required|string|max:25',
            'SegundoNombre' => 'nullable|string|max:25',
            'PrimerApellido' => 'required|string|max:25',
            'SegundoApellido' => 'nullable|string|max:30',
            'NumeroCelular' => 'required|string|max:15',
            'CorreoElectronico' => 'required|string|email|max:40|unique:usuario,CorreoElectronico',
            'Contraseña' => 'required|string|min:8|',
            'ConjuntoNombre' => 'required|string|max:25',
            'FechaNacimiento' => 'required|date',
            'Rol' => 'required|in:propietario,arrendatario,guardia,administrador',
            'TipoDocumento' => 'required|string|max:10',
            'NumDocumento' => 'required|integer',
        ]);

        $usuario = Usuario::create([
            'PrimerNombre' => $validated['PrimerNombre'],
            'SegundoNombre' => $validated['SegundoNombre'],
            'PrimerApellido' => $validated['PrimerApellido'],
            'SegundoApellido' => $validated['SegundoApellido'],
            'NumeroCelular' => $validated['NumeroCelular'],
            'CorreoElectronico' => $validated['CorreoElectronico'],
            'Contraseña' => bcrypt($validated['Contraseña']),
            'ConjuntoNombre' => $validated['ConjuntoNombre'],
            'FechaNacimiento' => $validated['FechaNacimiento'],
            'Rol' => $validated['Rol'],
            'TipoDocumento' => $validated['TipoDocumento'],
            'NumDocumento' => $validated['NumDocumento'],
        ]);

        return redirect()->route('Login.form')->with('status', '¡Registro exitoso! Por favor, inicia sesión.');
    }

}