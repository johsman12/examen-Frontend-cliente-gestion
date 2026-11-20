@extends('layouts.app')

@section('title', 'Detalle del Ingreso')

@section('content')
    <div class="box-lg">
        <div class="page-header">
            <div>
                <h1>Ingreso {{ $ingreso['codigo_ingreso'] }}</h1>
                <p class="text-muted">Fecha: <strong>{{ $ingreso['fecha'] }}</strong> — Habitacion: <span class="badge">{{ $ingreso['habitacion'] }}</span></p>
            </div>
            <div>
                <a href="{{ route('ingresos.edit', $ingreso['codigo_ingreso']) }}" class="btn btn-warning">Editar</a>
                <a href="{{ route('ingresos.index') }}" class="btn btn-secondary">← Volver</a>
            </div>
        </div>

        <div class="grid-2">
            <div class="card">
                <h2>Paciente Hospitalizado</h2>
                @if(!empty($ingreso['paciente']))
                    <div class="info-box">
                        <p><strong>{{ $ingreso['paciente']['nombre'] }} {{ $ingreso['paciente']['apellidos'] }}</strong></p>
                        <p class="text-muted">Código: {{ $ingreso['codigo_paciente'] }}</p>
                        <br>
                        <a href="{{ route('pacientes.show', $ingreso['codigo_paciente']) }}" class="link-view">Ver ficha completa del paciente →</a>
                    </div>
                @else
                    <p class="text-muted">Código: {{ $ingreso['codigo_paciente'] }}</p>
                @endif
            </div>

            <div class="card">
                <h2>Medico Responsable</h2>
                @if(!empty($ingreso['medico']))
                    <div class="info-box">
                        <p><strong>Dr(a). {{ $ingreso['medico']['nombre'] }} {{ $ingreso['medico']['apellidos'] }}</strong></p>
                        <p class="text-muted">Código: {{ $ingreso['codigo_medico'] }}</p>
                        <br>
                        <a href="{{ route('medicos.show', $ingreso['codigo_medico']) }}" class="link-view">Ver perfil del medico →</a>
                    </div>
                @else
                    <p class="text-muted">Codigo: {{ $ingreso['codigo_medico'] }}</p>
                @endif
            </div>
        </div>
    </div>
@endsection