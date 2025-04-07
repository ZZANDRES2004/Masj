@extends('layouts.app')

@section('content')
<div class="container">
    <h2>✏️ Editar Vehículo</h2>

    <form action="{{ route('vehiculos.update', $vehiculo->idVehiculo) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Placa</label>
            <input type="text" name="PlacaVehiculo" class="form-control" value="{{ $vehiculo->PlacaVehiculo }}" required>
        </div>

        <div class="mb-3">
            <label>Marca</label>
            <input type="text" name="MarcaVehiculo" class="form-control" value="{{ $vehiculo->MarcaVehiculo }}" required>
        </div>

        <div class="mb-3">
            <label>Modelo</label>
            <input type="text" name="ModeloVehiculo" class="form-control" value="{{ $vehiculo->ModeloVehiculo }}" required>
        </div>

        <div class="mb-3">
            <label>Hora de Ingreso</label>
            <input type="datetime-local" name="hora_ingreso" class="form-control"
                value="{{ $vehiculo->hora_ingreso ? \Carbon\Carbon::parse($vehiculo->hora_ingreso)->format('Y-m-d\TH:i') : '' }}">
        </div>

        <div class="mb-3">
            <label>Hora de Salida</label>
            <input type="datetime-local" name="hora_salida" class="form-control"
                value="{{ $vehiculo->hora_salida ? \Carbon\Carbon::parse($vehiculo->hora_salida)->format('Y-m-d\TH:i') : '' }}">
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('vehiculos.index') }}" class="btn btn-secondary">Volver</a>
    </form>
</div>
@endsection
