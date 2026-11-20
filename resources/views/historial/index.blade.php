@extends('layouts.app')

@section('title', 'Historial y Consultas Hospitalarias')

@section('content')
    <div class="page-header">
        <div>
            <h1>Historial y Consultas Hospitalarias</h1>
            <p class="text-muted">Consulta los ingresos atendidos por un medico o el historial de ingresos de un paciente</p>
        </div>
        @if($medicoSeleccionado || $pacienteSeleccionado)
            <a href="{{ route('historial.index') }}" class="btn btn-secondary">Limpiar filtros</a>
        @endif
    </div>

    <div class="grid-2">
        <div class="card">
            <h2>Consultar por Medico</h2>
            <p class="text-muted">Selecciona un medico para listar todos los ingresos que ha atendido.</p>
            <br>
            <form action="{{ route('historial.index') }}" method="GET" class="form-inline">
                <select name="codigo_medico" required>
                    <option value="">Selecciona un medico </option>
                    @foreach($medicos as $medico)
                        <option value="{{ $medico['codigo_medico'] }}" {{ request('codigo_medico') == $medico['codigo_medico'] ? 'selected' : '' }}>
                            {{ $medico['codigo_medico'] }} - Dr(a). {{ $medico['nombre'] }} {{ $medico['apellidos'] }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary">Consultar</button>
            </form>
        </div>

        <div class="card">
            <h2>Consultar por Paciente</h2>
            <p class="text-muted">Selecciona un paciente para consultar su historial de hospitalizaciones.</p>
            <br>
            <form action="{{ route('historial.index') }}" method="GET" class="form-inline">
                <select name="codigo_paciente" required>
                    <option value=""> Selecciona un paciente </option>
                    @foreach($pacientes as $paciente)
                        <option value="{{ $paciente['codigo_paciente'] }}" {{ request('codigo_paciente') == $paciente['codigo_paciente'] ? 'selected' : '' }}>
                            {{ $paciente['codigo_paciente'] }} - {{ $paciente['nombre'] }} {{ $paciente['apellidos'] }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-dark">Consultar</button>
            </form>
        </div>
    </div>

    @if($medicoSeleccionado)
        <div class="card">
            <div class="page-header">
                <div>
                    <h2>Ingresos Atendidos por Dr(a). {{ $medicoSeleccionado['nombre'] }} {{ $medicoSeleccionado['apellidos'] }}</h2>
                    <p class="text-muted">Código de Médico: <strong>{{ $medicoSeleccionado['codigo_medico'] }}</strong></p>
                </div>
                <span class="badge">{{ count($medicoSeleccionado['ingresos'] ?? []) }} ingreso(s)</span>
            </div>

            @if(!empty($medicoSeleccionado['ingresos']))
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>Código Ingreso</th>
                                <th>Fecha</th>
                                <th>Habitación</th>
                                <th>Paciente Atendido</th>
                                <th class="text-right">Detalle</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($medicoSeleccionado['ingresos'] as $ingreso)
                                <tr>
                                    <td><strong>{{ $ingreso['codigo_ingreso'] }}</strong></td>
                                    <td>{{ $ingreso['fecha'] }}</td>
                                    <td>Hab. {{ $ingreso['habitacion'] }}</td>
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
                <p class="text-muted">Este médico no tiene ingresos registrados.</p>
            @endif
        </div>
    @endif

    @if($pacienteSeleccionado)
        <div class="card">
            <div class="page-header">
                <div style="display: flex; align-items: center; gap: 1rem;">
                    @if(!empty($pacienteSeleccionado['foto_url']))
                        <img src="{{ $pacienteSeleccionado['foto_url'] }}" alt="Foto" class="avatar-sm">
                    @endif
                    <div>
                        <h2>Historial de Ingresos: {{ $pacienteSeleccionado['nombre'] }} {{ $pacienteSeleccionado['apellidos'] }}</h2>
                        <p class="text-muted">Código de Paciente: <strong>{{ $pacienteSeleccionado['codigo_paciente'] }}</strong></p>
                    </div>
                </div>
                <span class="badge">{{ count($pacienteSeleccionado['ingresos'] ?? []) }} ingreso(s)</span>
            </div>

            @if(!empty($pacienteSeleccionado['ingresos']))
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>Código Ingreso</th>
                                <th>Fecha</th>
                                <th>Habitación</th>
                                <th>Médico Responsable</th>
                                <th class="text-right">Detalle</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pacienteSeleccionado['ingresos'] as $ingreso)
                                <tr>
                                    <td><strong>{{ $ingreso['codigo_ingreso'] }}</strong></td>
                                    <td>{{ $ingreso['fecha'] }}</td>
                                    <td>Hab. {{ $ingreso['habitacion'] }}</td>
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
    @endif
@endsection