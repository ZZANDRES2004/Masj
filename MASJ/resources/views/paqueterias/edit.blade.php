@extends('layouts.app')
@section('content')
<div class="container">
    <h2 class="text-black mb-4">✏️ Editar Paquete</h2>
    <form action="{{ route('paqueterias.update', $paqueteria->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="remitente" class="form-label">Remitente</label>
            <input type="text" class="form-control" name="remitente" value="{{ $paqueteria->remitente }}" required>
        </div>
        <div class="mb-3">
            <label for="destinatario" class="form-label">Destinatario</label>
            <input type="text" class="form-control" name="destinatario" value="{{ $paqueteria->destinatario }}" required>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" name="descripcion" rows="3">{{ $paqueteria->descripcion }}</textarea>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" name="recibido" id="recibido" value="1" {{ $paqueteria->recibido ? 'checked' : '' }}>
            <label class="form-check-label" for="recibido">Recibido</label>
        </div>
        <button type="submit" class="btn btn-primary">💾 Actualizar</button>
        <a href="{{ route('paqueterias.index') }}" class="btn btn-secondary">↩️ Volver</a>
    </form>
</div>
@endsection