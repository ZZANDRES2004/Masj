<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use App\Models\Parqueadero;
use Illuminate\Http\Request;

class VehiculoController extends Controller
{
    public function index()
    {
        $vehiculos = Vehiculo::with('parqueadero')->get();
        return view('vehiculos.index', compact('vehiculos'));
    }

    public function create()
    {
        $bahias = Parqueadero::all();
        return view('vehiculos.Vcreate', compact('bahias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'PlacaVehiculo' => 'required|string|max:10',
            'MarcaVehiculo' => 'required|string|max:50',
            'ModeloVehiculo' => 'required|string|max:50',
            'idBahia' => 'required|exists:parqueadero,idBahia',
        ]);

        $data = $request->all();

        if ($request->filled(['hora_ingreso', 'hora_salida'])) {
            $ingreso = strtotime($request->hora_ingreso);
            $salida = strtotime($request->hora_salida);
            $horas = ceil(($salida - $ingreso) / 3600);
            $data['valor_pagado'] = $horas * 1000;
        }

        Vehiculo::create($data);

        return redirect()->route('vehiculos.index')->with('success', 'Vehículo registrado correctamente.');
    }

    public function edit($id)
    {
        $vehiculo = Vehiculo::findOrFail($id);
        return view('vehiculos.Vedit', compact('vehiculo'));
    }

    public function update(Request $request, $id)
    {
        $vehiculo = Vehiculo::findOrFail($id);
        $data = $request->all();

        if ($request->filled(['hora_ingreso', 'hora_salida'])) {
            $ingreso = strtotime($request->hora_ingreso);
            $salida = strtotime($request->hora_salida);
            $horas = ceil(($salida - $ingreso) / 3600);
            $data['valor_pagado'] = $horas * 1000;
        }

        $vehiculo->update($data);
        return redirect()->route('vehiculos.index')->with('success', 'Vehículo actualizado.');
    }

    public function destroy($id)
    {
        Vehiculo::destroy($id);
        return redirect()->route('vehiculos.index')->with('success', 'Vehículo eliminado.');
    }
}
