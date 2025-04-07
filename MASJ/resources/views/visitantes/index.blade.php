@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-black">🧍‍♂️ Control de Visitantes</h2>
            <a href="{{ route('visitantes.create') }}" class="btn btn-primary mb-2">➕ Agregar</a>
        </div>

        <div class="col-md-12">
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr class="text-center">
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Documento</th>
                        <th>Apartamento</th>
                        <th>Hora Entrada</th>
                        <th>Hora Salida</th>
                        <th style="width: 20%;">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($visitantes as $visitante)
                    <tr class="text-center">
                        <td>{{ $visitante->id }}</td>
                        <td>{{ $visitante->nombre }}</td>
                        <td>{{ $visitante->documento }}</td>
                        <td>{{ $visitante->apartamento }}</td>
                        <td>{{ $visitante->hora_entrada }}</td>
                        <td>{{ $visitante->hora_salida }}</td>
                        <td>
                            <a href="{{ route('visitantes.edit', $visitante->id) }}" class="btn btn-success btn-sm">✏️ Editar</a>
                            <form action="{{ route('visitantes.destroy', $visitante->id) }}" method="POST" style="display:inline-block;">
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
</div>
@endsection
