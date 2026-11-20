@extends('layouts.app')

@section('title', 'Editar Paciente')

@section('content')
    <div class="box-md">
        <div class="page-header">
            <h1>Editar Paciente</h1>
            <a href="{{ route('pacientes.index') }}" class="link-back">← Volver al listado</a>
        </div>

        <div class="card">
            <form action="{{ route('pacientes.update', $paciente['codigo_paciente']) }}" method="POST" enctype="multipart/form-data" class="form-stack">
                @csrf
                @method('PUT')

                <div>
                    <label>Código del Paciente</label>
                    <input type="text" value="{{ $paciente['codigo_paciente'] }}" disabled>
                </div>

                <div>
                    <label for="nombre">Nombre(s) *</label>
                    <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $paciente['nombre']) }}" maxlength="100" required>
                </div>

                <div>
                    <label for="apellidos">Apellidos *</label>
                    <input type="text" id="apellidos" name="apellidos" value="{{ old('apellidos', $paciente['apellidos']) }}" maxlength="100" required>
                </div>

                <div>
                    <label>Fotografía Actual</label>
                    @if(!empty($paciente['foto_url']))
                        <img src="{{ $paciente['foto_url'] }}" alt="Foto actual" class="avatar-preview">
                    @else
                        <p class="text-muted">Este paciente no tiene fotografía asignada.</p>
                    @endif
                </div>

                <div>
                    <label for="foto">Reemplazar Fotografía (opcional - JPG, PNG, WEBP, máx. 2MB)</label>
                    <input type="file" id="foto" name="foto" accept="image/jpeg,image/png,image/jpg,image/webp">
                </div>

                <div class="form-actions">
                    <a href="{{ route('pacientes.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-warning">Actualizar Paciente</button>
                </div>
            </form>
        </div>
    </div>
@endsection
