@extends('layouts.blank')


@section('content')
<div class="dashboard-container mx-auto p-4">
    <h2 class="text-center mb-4">👮 Panel del Guardia</h2>

    <div class="text-center mb-3">
        <p class="text-muted">Bienvenido al panel de control del guardia</p>
    </div>

    @if (session('success'))
        <div class="alert alert-success w-45 mx-auto text-center">
            ✅ {{ session('success') }}
        </div>
    @endif

    <div class="card mx-auto text-center shadow rounded p-4" style="max-width: 700px;">
        <h3 class="mb-3">📋 ¿Qué deseas hacer hoy?</h3>
        <div class="d-flex justify-content-center gap-2 flex-wrap">
            <a href="{{ route('visitantes.index') }}" class="btn btn-primary">🧍‍♂️ Ver Visitantes</a>
            <a href="{{ route('paqueterias.index') }}" class="btn btn-secondary">📦 Ver Paquetería</a>
            <a href="{{ route('vehiculos.index') }}" class="btn btn-dark">🚗 Ver Vehículos</a>
        </div>
    </div>
</div>
@endsection

