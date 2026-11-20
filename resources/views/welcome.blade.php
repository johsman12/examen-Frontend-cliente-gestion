@extends('layouts.app')

@section('title', 'Inicio - Gestión Hospitalaria')

@section('content')
    <div class="card">
        <h1>Sistema de Gestión Hospitalaria</h1>
        <p class="text-muted">
            Administra médicos, pacientes con soporte documental fotográfico e ingresos hospitalarios mediante servicios API REST.
        </p>
    </div>

    <div class="grid-cards">
        <a href="{{ route('medicos.index') }}" class="card card-link">
            <h2>Gestión de Médicos</h2>
            <p class="text-muted">Registrar, consultar, editar y eliminar médicos, y revisar los ingresos que atienden.</p>
        </a>

        <a href="{{ route('pacientes.index') }}" class="card card-link">
            <h2>Gestión de Pacientes</h2>
            <p class="text-muted">Administrar pacientes, cargar o actualizar su fotografía y consultar su historial clínico.</p>
        </a>

        <a href="{{ route('ingresos.index') }}" class="card card-link">
            <h2>Gestión de Ingresos</h2>
            <p class="text-muted">Registrar ingresos hospitalarios asociando médico, paciente, habitación y fecha.</p>
        </a>

        <a href="{{ route('historial.index') }}" class="card card-link">
            <h2>Historial y Consultas</h2>
            <p class="text-muted">Filtrar ingresos hospitalarios realizados por un paciente o atendidos por un médico específico.</p>
        </a>
    </div>
@endsection