@extends('layouts.app')

@section('title', 'Registrar Paciente')

@section('content')
    <div class="box-md">
        <div class="page-header">
            <h1>Registrar Paciente</h1>
            <a href="{{ route('pacientes.index') }}" class="link-back">← Volver al listado</a>
        </div>

        <div class="card">
            <form action="{{ route('pacientes.store') }}" method="POST" enctype="multipart/form-data" class="form-stack">
                @csrf

                <div>
                    <label for="codigo_paciente">Código del Paciente *</label>
                    <input type="text" id="codigo_paciente" name="codigo_paciente" value="{{ old('codigo_paciente') }}" maxlength="20" placeholder="Ej: PAC-001" required>
                </div>

                <div>
                    <label for="nombre">Nombre(s) *</label>
                    <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" maxlength="100" placeholder="Ej: María Fernanda" required>
                </div>

                <div>
                    <label for="apellidos">Apellidos *</label>
                    <input type="text" id="apellidos" name="apellidos" value="{{ old('apellidos') }}" maxlength="100" placeholder="Ej: López Martínez" required>
                </div>

                <div>
                    <label for="foto">Fotografía del Paciente (JPG, PNG, WEBP - máx. 2MB)</label>
                    <input type="file" id="foto" name="foto" accept="image/jpeg,image/png,image/jpg,image/webp">
                </div>

                <div class="form-actions">
                    <a href="{{ route('pacientes.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar Paciente</button>
                </div>
            </form>
        </div>
    </div>
@endsection