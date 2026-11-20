@extends('layouts.app')

@section('title', 'Gestión de Médicos')

@section('content')
    <div class="page-header">
        <div>
            <h1>Gestión de Medicos</h1>
            <p class="text-muted">Listado general de medicos registrados en la institución</p>
        </div>
        <a href="{{ route('medicos.create') }}" class="btn btn-primary">+ Nuevo Medico</a>
    </div>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Ingresos Atendidos</th>
                    <th class="text-right">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($medicos as $medico)
                    <tr>
                        <td><strong>{{ $medico['codigo_medico'] }}</strong></td>
                        <td>{{ $medico['nombre'] }}</td>
                        <td>{{ $medico['apellidos'] }}</td>
                        <td>
                            <span class="badge">{{ count($medico['ingresos'] ?? []) }} ingreso(s)</span>
                        </td>
                        <td class="text-right">
                            <a href="{{ route('medicos.show', $medico['codigo_medico']) }}" class="link-view">Ver</a>
                            <a href="{{ route('medicos.edit', $medico['codigo_medico']) }}" class="link-edit">Editar</a>
                            <form action="{{ route('medicos.destroy', $medico['codigo_medico']) }}" method="POST" class="inline-delete" onsubmit="return confirm('¿Seguro que deseas eliminar este médico?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">No hay medicos registrados todavía.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection