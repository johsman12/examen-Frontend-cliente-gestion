@extends('layouts.app')

@section('title', 'Editar Médico')

@section('content')
    <div class="box-md">
        <div class="page-header">
            <h1>Editar Medico</h1>
            <a href="{{ route('medicos.index') }}" class="link-back">← Volver al listado</a>
        </div>

        <div class="card">
            <form action="{{ route('medicos.update', $medico['codigo_medico']) }}" method="POST" class="form-stack">
                @csrf
                @method('PUT')

                <div>
                    <label>Codigo del Medico</label>
                    <input type="text" value="{{ $medico['codigo_medico'] }}" disabled>
                </div>

                <div>
                    <label for="nombre">Nombre(s) *</label>
                    <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $medico['nombre']) }}" maxlength="100" required>
                </div>

                <div>
                    <label for="apellidos">Apellidos *</label>
                    <input type="text" id="apellidos" name="apellidos" value="{{ old('apellidos', $medico['apellidos']) }}" maxlength="100" required>
                </div>

                <div class="form-actions">
                    <a href="{{ route('medicos.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-warning">Actualizar Medico</button>
                </div>
            </form>
        </div>
    </div>
@endsection