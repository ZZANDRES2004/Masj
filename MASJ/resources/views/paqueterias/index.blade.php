@extends('layouts.app')

@section('content')
<div class="paqueteria-container mx-auto p-4">
    <h2 class="text-center mb-4">📦 Registro de Paquetería</h2>

    <div class="text-center mb-3">
        <a href="{{ route('paqueterias.create') }}" class="btn btn-primary">➕ Agregar</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success w-75 mx-auto text-center">
            ✅ {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered w-100 text-center">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Remitente</th>
                    <th>Destinatario</th>
                    <th>Descripción</th>
                    <th>Recibido</th>
                    <th style="width: 20%;">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($paqueterias as $paquete)
                <tr>
                    <td>{{ $paquete->id }}</td>
                    <td>{{ $paquete->remitente }}</td>
                    <td>{{ $paquete->destinatario }}</td>
                    <td>{{ $paquete->descripcion }}</td>
                    <td>{{ $paquete->recibido ? '✅' : '❌' }}</td>
                    <td>
                        <a href="{{ route('paqueterias.edit', $paquete->id) }}" class="btn btn-success btn-sm">✏️ Editar</a>
                        <form action="{{ route('paqueterias.destroy', $paquete->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este paquete?')">🗑️ Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
