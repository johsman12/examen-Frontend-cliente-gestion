@extends('layouts.app')

@section('title', 'Registrar Ingreso')

@section('content')
    <div class="box-md">
        <div class="page-header">
            <h1>Registrar Ingreso Hospitalario</h1>
            <a href="{{ route('ingresos.index') }}" class="link-back">← Volver al listado</a>
        </div>

        <div class="card">
            <form action="{{ route('ingresos.store') }}" method="POST" class="form-stack">
                @csrf

                <div>
                    <label for="codigo_ingreso">Codigo de Ingreso *</label>
                    <input type="text" id="codigo_ingreso" name="codigo_ingreso" value="{{ old('codigo_ingreso') }}" maxlength="20" placeholder="Ej: ING-001" required>
                </div>

                <div>
                    <label for="habitacion">Habitacion Asignada *</label>
                    <input type="text" id="habitacion" name="habitacion" value="{{ old('habitacion') }}" maxlength="20" placeholder="Ej: 204-A" required>
                </div>

                <div>
                    <label for="fecha">Fecha de Ingreso *</label>
                    <input type="date" id="fecha" name="fecha" value="{{ old('fecha', date('Y-m-d')) }}" required>
                </div>

                <div>
                    <label for="codigo_paciente">Paciente *</label>
                    <select id="codigo_paciente" name="codigo_paciente" required>
                        <option value="">-- Selecciona un paciente --</option>
                        @foreach($pacientes as $paciente)
                            <option value="{{ $paciente['codigo_paciente'] }}" {{ old('codigo_paciente') == $paciente['codigo_paciente'] ? 'selected' : '' }}>
                                {{ $paciente['codigo_paciente'] }} - {{ $paciente['nombre'] }} {{ $paciente['apellidos'] }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="codigo_medico">Medico Responsable *</label>
                    <select id="codigo_medico" name="codigo_medico" required>
                        <option value="">-- Selecciona un medico --</option>
                        @foreach($medicos as $medico)
                            <option value="{{ $medico['codigo_medico'] }}" {{ old('codigo_medico') == $medico['codigo_medico'] ? 'selected' : '' }}>
                                {{ $medico['codigo_medico'] }} - Dr(a). {{ $medico['nombre'] }} {{ $medico['apellidos'] }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-actions">
                    <a href="{{ route('ingresos.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar Ingreso</button>
                </div>
            </form>
        </div>
    </div>
@endsection