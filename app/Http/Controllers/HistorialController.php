<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HistorialController extends Controller
{
    public function index(Request $request)
    {
        // Cargo todos los medicos y pacientes para los filtros de consulta
        $medicos = $this->apiGet('medicos') ?? [];
        $pacientes = $this->apiGet('pacientes') ?? [];

        $medicoSeleccionado = null;
        $pacienteSeleccionado = null;

        // Si el usuario filtro por medico, consulto los ingresos que ha atendido
        if ($request->filled('codigo_medico')) {
            $medicoSeleccionado = $this->apiGet("medicos/{$request->codigo_medico}/ingresos");
        }

        // Si el usuario filtro por paciente, consulto su historial de ingresos
        if ($request->filled('codigo_paciente')) {
            $pacienteSeleccionado = $this->apiGet("pacientes/{$request->codigo_paciente}/ingresos");
        }

        return view('historial.index', compact(
            'medicos',
            'pacientes',
            'medicoSeleccionado',
            'pacienteSeleccionado'
        ));
    }
}