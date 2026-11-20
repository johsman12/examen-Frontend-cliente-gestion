@extends('layouts.app')

@section('title', 'Detalle del Paciente')

@section('content')
    <div class="box-lg">
        <div class="page-header">
            <h1>Ficha del Paciente</h1>
            <div>
                <a href="{{ route('pacientes.edit', $paciente['codigo_paciente']) }}" class="btn btn-warning">Editar</a>
                <a href="{{ route('pacientes.index') }}" class="btn btn-secondary">← Volver</a>
            </div>
        </div>

        <div class="profile-header">
            @if(!empty($paciente['foto_url']))
                <img src="{{ $paciente['foto_url'] }}" alt="Foto de {{ $paciente['nombre'] }}" class="avatar-lg">
            @else
                <div class="avatar-placeholder-lg">Sin foto</div>
            @endif

            <div>
                <h2>{{ $paciente['nombre'] }} {{ $paciente['apellidos'] }}</h2>
                <p class="text-muted">Código de Paciente: <strong>{{ $paciente['codigo_paciente'] }}</strong></p>
                <p class="text-muted">Total de ingresos registrados: <span class="badge">{{ count($paciente['ingresos'] ?? []) }}</span></p>
            </div>
        </div>

        <div class="card">
            <h2>Historial de Ingresos Hospitalarios</h2>

            @if(!empty($paciente['ingresos']))
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>Codigo Ingreso</th>
                                <th>Fecha</th>
                                <th>Habitacion</th>
                                <th>Medico Responsable</th>
                                <th class="text-right">Detalle</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($paciente['ingresos'] as $ingreso)
                                <tr>
                                    <td><strong>{{ $ingreso['codigo_ingreso'] }}</strong></td>
                                    <td>{{ $ingreso['fecha'] }}</td>
                                    <td>{{ $ingreso['habitacion'] }}</td>
                                    <td>
                                        @if(!empty($ingreso['medico']))
                                            Dr(a). {{ $ingreso['medico']['nombre'] }} {{ $ingreso['medico']['apellidos'] }}
                                            <span class="text-muted">({{ $ingreso['codigo_medico'] }})</span>
                                        @else
                                            {{ $ingreso['codigo_medico'] }}
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
                <p class="text-muted">Este paciente no registra ingresos hospitalarios.</p>
            @endif
        </div>
    </div>
@endsection