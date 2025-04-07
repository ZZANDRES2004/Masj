@extends('layouts.app')

@section('content')
<div class="container">
    <h2>🚗 Registro de Vehículos</h2>
    <a href="{{ route('vehiculos.create') }}" class="btn btn-primary mb-3">➕ Agregar</a>

    <table class="table table-bordered">
        <thead class="table-dark text-center">
            <tr>
                <th>ID</th>
                <th>Placa</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Bahía</th>
                <th>Ingreso</th>
                <th>Salida</th>
                <th>Valor</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @foreach($vehiculos as $vehiculo)
            <tr>
                <td>{{ $vehiculo->idVehiculo }}</td>
                <td>{{ $vehiculo->PlacaVehiculo }}</td>
                <td>{{ $vehiculo->MarcaVehiculo }}</td>
                <td>{{ $vehiculo->ModeloVehiculo }}</td>
                <td>{{ $vehiculo->parqueadero->idBahia ?? 'N/A' }}</td>
                <td>{{ $vehiculo->hora_ingreso }}</td>
                <td>{{ $vehiculo->hora_salida }}</td>
                <td>${{ $vehiculo->valor_pagado }}</td>
                <td>
                    <a href="{{ route('vehiculos.edit', $vehiculo->idVehiculo) }}" class="btn btn-sm btn-success">✏️ Editar</a>
                    <form action="{{ route('vehiculos.destroy', $vehiculo->idVehiculo) }}" method="POST" style="display:inline-block;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este vehículo?')">🗑️</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
