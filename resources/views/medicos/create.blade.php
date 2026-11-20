@extends('layouts.app')

@section('title', 'Registrar Médico')

@section('content')
    <div class="box-md">
        <div class="page-header">
            <h1>Registrar Medico</h1>
            <a href="{{ route('medicos.index') }}" class="link-back">← Volver al listado</a>
        </div>

        <div class="card">
            <form action="{{ route('medicos.store') }}" method="POST" class="form-stack">
                @csrf

                <div>
                    <label for="codigo_medico">Codigo del Medico *</label>
                    <input type="text" id="codigo_medico" name="codigo_medico" value="{{ old('codigo_medico') }}" maxlength="20" placeholder="Ej: MED-001" required>
                </div>

                <div>
                    <label for="nombre">Nombre(s) *</label>
                    <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" maxlength="100" placeholder="Ej: Carlos Andrés" required>
                </div>

                <div>
                    <label for="apellidos">Apellidos *</label>
                    <input type="text" id="apellidos" name="apellidos" value="{{ old('apellidos') }}" maxlength="100" placeholder="Ej: Gómez Pérez" required>
                </div>

                <div class="form-actions">
                    <a href="{{ route('medicos.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar Medico</button>
                </div>
            </form>
        </div>
    </div>
@endsection