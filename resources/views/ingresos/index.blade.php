@extends('layouts.app')

@section('title', 'Gestión de Ingresos')

@section('content')
    <div class="page-header">
        <div>
            <h1>Gestion de Ingresos Hospitalarios</h1>
            <p class="text-muted">Listado general de ingresos, pacientes hospitalizados y medicos asignados</p>
        </div>
        <a href="{{ route('ingresos.create') }}" class="btn btn-primary">+ Nuevo Ingreso</a>
    </div>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Codigo Ingreso</th>
                    <th>Fecha</th>
                    <th>Habitacion</th>
                    <th>Paciente</th>
                    <th>Medico Responsable</th>
                    <th class="text-right">Acciones</th>
                </tr>
            </thead> ungload
            <tbody>
                @forelse($ingresos as $ingreso)
                    <tr>
                        <td><strong>{{ $ingreso['codigo_ingreso'] }}</strong></td>
                        <td>{{ $ingreso['fecha'] }}</td>
                        <td><span class="badge">Hab. {{ $ingreso['habitacion'] }}</span></td>
                        <td>
                            @if(!empty($ingreso['paciente']))
                                {{ $ingreso['paciente']['nombre'] }} {{ $ingreso['paciente']['apellidos'] }}
                                <span class="text-muted">({{ $ingreso['codigo_paciente'] }})</span>
                            @else
                                {{ $ingreso['codigo_paciente'] }}
                            @endif
                        </td>
                        <td>
                            @if(!empty($ingreso['medico']))
                                Dr(a). {{ $ingreso['medico']['nombre'] }} {{ $ingreso['medico']['apellidos'] }}
                                <span class="text-muted">({{ $ingreso['codigo_medico'] }})</span>
                            @else
                                {{ $ingreso['codigo_medico'] }}
                            @endif
                        </td>
                        <td class="text-right">
                            <a href="{{ route('ingresos.show', $ingreso['codigo_ingreso']) }}" class="link-view">Ver</a>
                            <a href="{{ route('ingresos.edit', $ingreso['codigo_ingreso']) }}" class="link-edit">Editar</a>
                            <form action="{{ route('ingresos.destroy', $ingreso['codigo_ingreso']) }}" method="POST" class="inline-delete" onsubmit="return confirm('¿Seguro que deseas eliminar este ingreso hospitalario?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">No hay ingresos hospitalarios registrados todavía.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection