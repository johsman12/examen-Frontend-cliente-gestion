@extends('layouts.app')

@section('title', 'Editar Ingreso')

@section('content')
    <div class="box-md">
        <div class="page-header">
            <h1>Editar Ingreso Hospitalario</h1>
            <a href="{{ route('ingresos.index') }}" class="link-back">← Volver al listado</a>
        </div>

        <div class="card">
            <form action="{{ route('ingresos.update', $ingreso['codigo_ingreso']) }}" method="POST" class="form-stack">
                @csrf
                @method('PUT')

                <div>
                    <label>Código de Ingreso</label>
                    <input type="text" value="{{ $ingreso['codigo_ingreso'] }}" disabled>
                </div>

                <div>
                    <label for="habitacion">Habitacion Asignada *</label>
                    <input type="text" id="habitacion" name="habitacion" value="{{ old('habitacion', $ingreso['habitacion']) }}" maxlength="20" required>
                </div>

                <div>
                    <label for="fecha">Fecha de Ingreso *</label>
                    <input type="date" id="fecha" name="fecha" value="{{ old('fecha', $ingreso['fecha']) }}" required>
                </div>

                <div>
                    <label for="codigo_paciente">Paciente *</label>
                    <select id="codigo_paciente" name="codigo_paciente" required>
                        <option value=""> Selecciona un paciente </option>
                        @foreach($pacientes as $paciente)
                            <option value="{{ $paciente['codigo_paciente'] }}" {{ old('codigo_paciente', $ingreso['codigo_paciente']) == $paciente['codigo_paciente'] ? 'selected' : '' }}>
                                {{ $paciente['codigo_paciente'] }} - {{ $paciente['nombre'] }} {{ $paciente['apellidos'] }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="codigo_medico">Medico Responsable *</label>
                    <select id="codigo_medico" name="codigo_medico" required>
                        <option value=""> Selecciona un médico </option>
                        @foreach($medicos as $medico)
                            <option value="{{ $medico['codigo_medico'] }}" {{ old('codigo_medico', $ingreso['codigo_medico']) == $medico['codigo_medico'] ? 'selected' : '' }}>
                                {{ $medico['codigo_medico'] }} - Dr(a). {{ $medico['nombre'] }} {{ $medico['apellidos'] }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-actions">
                    <a href="{{ route('ingresos.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-warning">Actualizar Ingreso</button>
                </div>
            </form>
        </div>
    </div>
@endsection