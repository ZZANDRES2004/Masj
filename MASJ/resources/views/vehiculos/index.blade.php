@extends('layouts.app')

@section('content')
<div class="vehiculos-container mx-auto p-4">
    <h2 class="text-center mb-4">🚗 Registro de Vehículos</h2>

    <div class="text-center mb-3">
        <a href="{{ route('vehiculos.create') }}" class="btn btn-primary">➕ Agregar</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success w-75 mx-auto text-center">
            ✅ {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered w-100 text-center">
            <thead class="table-dark">
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
            <tbody>
                @foreach($vehiculos as $vehiculo)
                <tr>
                    <td>{{ $vehiculo->idVehiculo }}</td>
                    <td>{{ $vehiculo->PlacaVehiculo }}</td>
                    <td>{{ $vehiculo->MarcaVehiculo }}</td>
                    <td>{{ $vehiculo->ModeloVehiculo }}</td>
                    <td>{{ $vehiculo->parqueadero->idBahia ?? 'N/A' }}</td>
                    <td>{{ $vehiculo->hora_ingreso }}</td>
                    <td>{{ $vehiculo->hora_salida ?? '—' }}</td>
                    <td>
                        @if($vehiculo->valor_pagado)
                            ${{ $vehiculo->valor_pagado }}
                        @else
                            —
                        @endif
                    </td>
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
</div>
@endsection


