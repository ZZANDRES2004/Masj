@extends('layouts.app') {{-- Usa tu layout base si tienes uno --}}

@section('content')
<div class="container">
    <h2>Quejas</h2>

    <form action="{{ route('quejas.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="descripcion">Descripción de la queja:</label>
            <textarea name="descripcion" id="descripcion" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Enviar Queja</button>
    </form>

    <hr>

    <h4>Historial de quejas</h4>
    @if(count($quejas) > 0)
        @foreach ($quejas as $queja)
            <div class="mb-4 p-3 border rounded">
                <p><strong>Fecha:</strong> {{ $queja->created_at->format('Y-m-d') }}</p>
                <p><strong>Descripción:</strong> {{ $queja->descripcion }}</p>
                <p><strong>Estado:</strong> {{ $queja->estado }}</p>
            </div>
        @endforeach
    @else
        <p>No hay quejas registradas.</p>
    @endif
</div>
@endsection
