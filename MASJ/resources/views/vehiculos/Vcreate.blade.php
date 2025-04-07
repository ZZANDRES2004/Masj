@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Registrar Vehículo</h2>
    <form action="{{ route('vehiculos.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Placa</label>
            <input type="text" name="PlacaVehiculo" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Marca</label>
            <input type="text" name="MarcaVehiculo" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Modelo</label>
            <input type="text" name="ModeloVehiculo" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Bahía</label>
            <select name="idBahia" class="form-select" required>
                <option value="">-- Selecciona una --</option>
                @foreach($bahias as $bahia)
                    <option value="{{ $bahia->idBahia }}">{{ $bahia->idBahia }} - {{ $bahia->Estado }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Hora de Ingreso</label>
            <input type="datetime-local" name="hora_ingreso" class="form-control">
        </div>

        <div class="mb-3">
            <label>Hora de Salida</label>
            <input type="datetime-local" name="hora_salida" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection
