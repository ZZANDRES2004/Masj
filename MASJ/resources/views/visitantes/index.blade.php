@extends('layouts.app')

@section('content')
<div class="visitantes-container mx-auto p-4">
    <h2 class="text-center mb-4">🧍‍♂️ Control de Visitantes</h2>

    <div class="text-center mb-3">
        <a href="{{ route('visitantes.create') }}" class="btn btn-primary">➕ Agregar</a>
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
                    <th>Nombre Completo</th>
                    <th>Tipo Doc</th>
                    <th>Número</th>
                    <th>Apartamento</th>
                    <th>Hora Entrada</th>
                    <th>Hora Salida</th>
                    <th style="width: 20%;">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($visitantes as $visitante)
                <tr>
                    <td>{{ $visitante->idVisitante }}</td>
                    <td>{{ $visitante->NombresVisitante }} {{ $visitante->ApellidosVisitante }}</td>
                    <td>{{ $visitante->TipoDocumento }}</td>
                    <td>{{ $visitante->NumDocumento }}</td>
                    <td>{{ $visitante->apartamento }}</td>
                    <td>{{ $visitante->hora_entrada }}</td>
                    <td>{{ $visitante->hora_salida ?? '—' }}</td>
                    <td>
                        <a href="{{ route('visitantes.edit', $visitante->idVisitante) }}" class="btn btn-success btn-sm">✏️ Editar</a>
                        <form action="{{ route('visitantes.destroy', $visitante->idVisitante) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este visitante?')">🗑️ Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
