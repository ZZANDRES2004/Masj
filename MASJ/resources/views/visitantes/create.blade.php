@extends('layouts.app')

@section('content')
<div class="container">
    <h2>➕ Registrar Visitante</h2>

    @if($errors->any())
        <div class="alert alert-danger small">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>⚠️ {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('visitantes.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" maxlength="255" value="{{ old('nombre') }}" required>
        </div>

        <div class="mb-3">
            <label for="documento" class="form-label">Documento</label>
            <input type="text" name="documento" class="form-control" maxlength="50" value="{{ old('documento') }}" required>
        </div>

        <div class="mb-3">
            <label for="apartamento" class="form-label">Apartamento que visitas</label>
            <input type="text" name="apartamento" class="form-control" maxlength="255" value="{{ old('apartamento') }}" required>
        </div>

        <div class="mb-3">
            <label for="hora_entrada" class="form-label">Hora de Entrada</label>
            <input type="time" name="hora_entrada" class="form-control" value="{{ old('hora_entrada') }}">
        </div>

        <div class="mb-3">
            <label for="hora_salida" class="form-label">Hora de Salida</label>
            <input type="time" name="hora_salida" class="form-control" value="{{ old('hora_salida') }}">
        </div>

        <button type="submit" class="btn btn-primary">✅ Guardar</button>
    </form>
</div>
@endsection
