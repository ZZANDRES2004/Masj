@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Registrar Paquete</h2>
    @if($errors->any())
        <div class="alert alert-danger small">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('paqueterias.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="remitente" class="form-label">Remitente</label>
            <input type="text" name="remitente" class="form-control" maxlength="255" required>
        </div>
        <div class="mb-3">
            <label for="destinatario" class="form-label">Destinatario</label>
            <input type="text" name="destinatario" class="form-control" maxlength="255" required>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control" rows="3"></textarea>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" name="recibido" class="form-check-input" id="recibido" value="1">
            <label class="form-check-label" for="recibido">Recibido</label>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection