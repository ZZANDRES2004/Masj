<?php
namespace App\Http\Controllers;
use App\Models\Paqueteria;
use Illuminate\Http\Request;
class PaqueteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paqueterias = Paqueteria::all();
        return view('paqueterias.index', ['paqueterias' => $paqueterias]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('paqueterias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'remitente' => 'required|string|max:255',
            'destinatario' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'recibido' => 'boolean',
        ], [
            'required' => 'Completa los datos por favor.'
        ]);
        
        Paqueteria::create($request->all());
        return redirect()->route('paqueterias.index')->with('success', 'Paquete registrado exitosamente');
    }
    /**
     * Display the specified resource.
     */
    public function show(Paqueteria $paqueteria)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $paqueteria = Paqueteria::findOrFail($id);
        return view('paqueterias.edit', compact('paqueteria'));
    }

    public function update(Request $request, $id)
    {
        $paqueteria = Paqueteria::findOrFail($id);
        $paqueteria->update($request->all());
        return redirect()->route('paqueterias.index')->with('success', 'Paquete actualizado.');
    }

    public function destroy($id)
    {
        $paqueteria = Paqueteria::findOrFail($id);
        $paqueteria->delete();
        return redirect()->route('paqueterias.index')->with('success', 'Paquete eliminado.');
    }
}