@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-black">📦 Registro de Paquetería</h2>
            <a href="{{ route('paqueterias.create') }}" class="btn btn-primary mb-2">➕ Agregar</a>
        </div>

        <div class="col-md-12">
            @if (session('success'))
                <div class="alert alert-success">
                    ✅ {{ session('success') }}
                </div>
            @endif
        <div class="col-md-12">
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr class="text-center">
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
                    <tr class="text-center">
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
</div>
@endsection
