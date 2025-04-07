@extends('layouts.app')

@section('content')
<div class="container">
    <h2>➕ Registrar Visitante</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>⚠️ {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('visitantes.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="NombresVisitante" class="form-label">Nombres</label>
            <input type="text" name="NombresVisitante" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="ApellidosVisitante" class="form-label">Apellidos</label>
            <input type="text" name="ApellidosVisitante" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="TipoDocumento" class="form-label">Tipo de Documento</label>
            <select name="TipoDocumento" class="form-select" required>
                <option value="CC">Cédula</option>
                <option value="TI">Tarjeta de Identidad</option>
                <option value="CE">Cédula de Extranjería</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="NumDocumento" class="form-label">Número de Documento</label>
            <input type="text" name="NumDocumento" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="apartamento" class="form-label">Apartamento</label>
            <input type="text" name="apartamento" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="hora_entrada" class="form-label">Hora de Entrada</label>
            <input type="time" name="hora_entrada" class="form-control">
        </div>

        <div class="mb-3">
            <label for="hora_salida" class="form-label">Hora de Salida</label>
            <input type="time" name="hora_salida" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">✅ Registrar</button>
        <a href="{{ route('visitantes.index') }}" class="btn btn-secondary">🔙 Volver</a>
    </form>
</div>
@endsection
