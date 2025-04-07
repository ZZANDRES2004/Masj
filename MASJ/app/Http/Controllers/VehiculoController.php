<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehiculo;
use App\Models\Parqueadero;
use Carbon\Carbon;

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
        $vehiculo = new Vehiculo();
        $vehiculo->PlacaVehiculo = $request->PlacaVehiculo;
        $vehiculo->MarcaVehiculo = $request->MarcaVehiculo;
        $vehiculo->ModeloVehiculo = $request->ModeloVehiculo;
        $vehiculo->idBahia = $request->idBahia;
        $vehiculo->hora_ingreso = $request->hora_ingreso;
        $vehiculo->hora_salida = $request->hora_salida;

        // Calcular valor pagado si hay hora de salida
        if ($request->hora_ingreso && $request->hora_salida) {
            $inicio = Carbon::parse($request->hora_ingreso);
            $fin = Carbon::parse($request->hora_salida);
            $horas = ceil($inicio->diffInMinutes($fin) / 60);
            $vehiculo->valor_pagado = $horas * 1000;
        }

        $vehiculo->save();

        return redirect()->route('vehiculos.index')->with('success', 'Vehículo registrado correctamente');
    }

    public function edit($id)
    {
        $vehiculo = Vehiculo::findOrFail($id);
        return view('vehiculos.Vedit', compact('vehiculo'));
    }

    public function update(Request $request, $id)
    {
        $vehiculo = Vehiculo::findOrFail($id);
        $vehiculo->PlacaVehiculo = $request->PlacaVehiculo;
        $vehiculo->MarcaVehiculo = $request->MarcaVehiculo;
        $vehiculo->ModeloVehiculo = $request->ModeloVehiculo;
        $vehiculo->hora_ingreso = $request->hora_ingreso;
        $vehiculo->hora_salida = $request->hora_salida;

        if ($request->hora_ingreso && $request->hora_salida) {
            $inicio = Carbon::parse($request->hora_ingreso);
            $fin = Carbon::parse($request->hora_salida);
            $horas = ceil($inicio->diffInMinutes($fin) / 60);
            $vehiculo->valor_pagado = $horas * 1000;
        } else {
            $vehiculo->valor_pagado = null;
        }

        $vehiculo->save();

        return redirect()->route('vehiculos.index')->with('success', 'Vehículo actualizado correctamente');
    }

    public function destroy($id)
    {
        Vehiculo::findOrFail($id)->delete();
        return redirect()->route('vehiculos.index')->with('success', 'Vehículo eliminado correctamente');
    }
}
