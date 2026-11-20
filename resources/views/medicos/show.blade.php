@extends('layouts.app')

@section('title', 'Detalle del Médico')

@section('content')
    <div class="box-lg">
        <div class="page-header">
            <div>
                <h1>{{ $medico['nombre'] }} {{ $medico['apellidos'] }}</h1>
                <p class="text-muted">Codigo de Medico: <strong>{{ $medico['codigo_medico'] }}</strong></p>
            </div>
            <div>
                <a href="{{ route('medicos.edit', $medico['codigo_medico']) }}" class="btn btn-warning">Editar</a>
                <a href="{{ route('medicos.index') }}" class="btn btn-secondary">← Volver</a>
            </div>
        </div>

        <div class="card">
            <h2>Ingresos Hospitalarios Atendidos ({{ count($medico['ingresos'] ?? []) }})</h2>

            @if(!empty($medico['ingresos']))
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>Codigo Ingreso</th>
                                <th>Fecha</th>
                                <th>Habitacion</th>
                                <th>Paciente</th>
                                <th class="text-right">Detalle</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($medico['ingresos'] as $ingreso)
                                <tr>
                                    <td><strong>{{ $ingreso['codigo_ingreso'] }}</strong></td>
                                    <td>{{ $ingreso['fecha'] }}</td>
                                    <td>{{ $ingreso['habitacion'] }}</td>
                                    <td>
                                        @if(!empty($ingreso['paciente']))
                                            {{ $ingreso['paciente']['nombre'] }} {{ $ingreso['paciente']['apellidos'] }}
                                            <span class="text-muted">({{ $ingreso['codigo_paciente'] }})</span>
                                        @else
                                            {{ $ingreso['codigo_paciente'] }}
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        <a href="{{ route('ingresos.show', $ingreso['codigo_ingreso']) }}" class="link-view">Ver ingreso</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-muted">Este medico aún no tiene ingresos hospitalarios registrados.</p>
            @endif
        </div>
    </div>
@endsection