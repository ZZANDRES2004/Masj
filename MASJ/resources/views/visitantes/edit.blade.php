@extends('layouts.app')

@section('content')
<div class="container">
    <h2>✏️ Editar Visitante</h2>

    <form action="{{ route('visitantes.update', $visitante->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $visitante->nombre) }}" required>
        </div>

        <div class="mb-3">
            <label for="documento">Documento:</label>
            <input type="text" name="documento" class="form-control" value="{{ old('documento', $visitante->documento) }}" required>
        </div>

        <div class="mb-3">
            <label for="apartamento">Apartamento que visitas:</label>
            <input type="text" name="apartamento" class="form-control" value="{{ old('apartamento', $visitante->apartamento) }}" required>
        </div>

        <div class="mb-3">
            <label for="hora_entrada">Hora de entrada:</label>
            <input type="time" name="hora_entrada" class="form-control" value="{{ old('hora_entrada', $visitante->hora_entrada) }}">
        </div>

        <div class="mb-3">
            <label for="hora_salida">Hora de salida:</label>
            <input type="time" name="hora_salida" class="form-control" value="{{ old('hora_salida', $visitante->hora_salida) }}">
        </div>

        <button type="submit" class="btn btn-primary">💾 Guardar cambios</button>
    </form>
</div>
@endsection
