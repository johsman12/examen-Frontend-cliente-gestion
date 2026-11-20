@extends('layouts.app')

@section('title', 'Gestión de Pacientes')

@section('content')
    <div class="page-header">
        <div>
            <h1>Gestion de Pacientes</h1>
            <p class="text-muted">Listado de pacientes registrados y su soporte fotografico</p>
        </div>
        <a href="{{ route('pacientes.create') }}" class="btn btn-primary">+ Nuevo Paciente</a>
    </div>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Fotografia</th>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Ingresos</th>
                    <th class="text-right">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pacientes as $paciente)
                    <tr>
                        <td>
                            @if(!empty($paciente['foto_url']))
                                <img src="{{ $paciente['foto_url'] }}" alt="Foto de {{ $paciente['nombre'] }}" class="avatar-sm">
                            @else
                                <div class="avatar-placeholder">Sin foto</div>
                            @endif
                        </td>
                        <td><strong>{{ $paciente['codigo_paciente'] }}</strong></td>
                        <td>{{ $paciente['nombre'] }}</td>
                        <td>{{ $paciente['apellidos'] }}</td>
                        <td>
                            <span class="badge">{{ count($paciente['ingresos'] ?? []) }} ingreso(s)</span>
                        </td>
                        <td class="text-right">
                            <a href="{{ route('pacientes.show', $paciente['codigo_paciente']) }}" class="link-view">Ver</a>
                            <a href="{{ route('pacientes.edit', $paciente['codigo_paciente']) }}" class="link-edit">Editar</a>
                            <form action="{{ route('pacientes.destroy', $paciente['codigo_paciente']) }}" method="POST" class="inline-delete" onsubmit="return confirm('¿Seguro que deseas eliminar este paciente?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">No hay pacientes registrados todavía.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection