@extends('layouts.app')

@section('content')
<div class="container">
    <h2>✏️ Editar Visitante</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>⚠️ {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('visitantes.update', $visitante->idVisitante) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="NombresVisitante" class="form-label">Nombres</label>
            <input type="text" name="NombresVisitante" class="form-control" value="{{ $visitante->NombresVisitante }}" required>
        </div>

        <div class="mb-3">
            <label for="ApellidosVisitante" class="form-label">Apellidos</label>
            <input type="text" name="ApellidosVisitante" class="form-control" value="{{ $visitante->ApellidosVisitante }}" required>
        </div>

        <div class="mb-3">
            <label for="TipoDocumento" class="form-label">Tipo de Documento</label>
            <select name="TipoDocumento" class="form-select" required>
                <option value="CC" {{ $visitante->TipoDocumento == 'CC' ? 'selected' : '' }}>Cédula</option>
                <option value="TI" {{ $visitante->TipoDocumento == 'TI' ? 'selected' : '' }}>Tarjeta de Identidad</option>
                <option value="CE" {{ $visitante->TipoDocumento == 'CE' ? 'selected' : '' }}>Cédula de Extranjería</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="NumDocumento" class="form-label">Número de Documento</label>
            <input type="text" name="NumDocumento" class="form-control" value="{{ $visitante->NumDocumento }}" required>
        </div>

        <div class="mb-3">
            <label for="apartamento" class="form-label">Apartamento</label>
            <input type="text" name="apartamento" class="form-control" value="{{ $visitante->apartamento }}" required>
        </div>

        <div class="mb-3">
            <label for="hora_entrada" class="form-label">Hora de Entrada</label>
            <input type="time" name="hora_entrada" class="form-control" value="{{ $visitante->hora_entrada }}">
        </div>

        <div class="mb-3">
            <label for="hora_salida" class="form-label">Hora de Salida</label>
            <input type="time" name="hora_salida" class="form-control" value="{{ $visitante->hora_salida }}">
        </div>

        <button type="submit" class="btn btn-success">💾 Actualizar</button>
        <a href="{{ route('visitantes.index') }}" class="btn btn-secondary">🔙 Volver</a>
    </form>
</div>
@endsection
