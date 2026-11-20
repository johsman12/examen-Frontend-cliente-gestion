<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IngresoController extends Controller
{
    public function index()
    {
        // Consulto todos los ingresos hospitalarios junto con su medico y paciente
        $ingresos = $this->apiGet('ingresos') ?? [];
        return view('ingresos.index', compact('ingresos'));
    }

    public function create()
    {
        // Cargo los medicos y pacientes disponibles para las listas desplegables
        $medicos = $this->apiGet('medicos') ?? [];
        $pacientes = $this->apiGet('pacientes') ?? [];
        return view('ingresos.create', compact('medicos', 'pacientes'));
    }

    public function store(Request $request)
    {
        // Envio el nuevo ingreso hospitalario mediante POST a la API
        $response = $this->apiWrite('post', 'ingresos', $request->only([
            'codigo_ingreso', 'habitacion', 'fecha', 'codigo_medico', 'codigo_paciente',
        ]));

        if ($response->successful()) {
            return redirect()->route('ingresos.index')->with('success', 'Ingreso hospitalario registrado correctamente.');
        }

        return back()->withInput()->withErrors($response->json('errors') ?? ['error' => $response->json('message') ?? 'Error al registrar el ingreso.']);
    }

    public function show($codigo)
    {
        $ingreso = $this->apiGet("ingresos/{$codigo}");

        if (!$ingreso) {
            return redirect()->route('ingresos.index')->with('error', 'Ingreso no encontrado.');
        }

        return view('ingresos.show', compact('ingreso'));
    }

    public function edit($codigo)
    {
        $ingreso = $this->apiGet("ingresos/{$codigo}");
        $medicos = $this->apiGet('medicos') ?? [];
        $pacientes = $this->apiGet('pacientes') ?? [];

        if (!$ingreso) {
            return redirect()->route('ingresos.index')->with('error', 'Ingreso no encontrado.');
        }

        return view('ingresos.edit', compact('ingreso', 'medicos', 'pacientes'));
    }

    public function update(Request $request, $codigo)
    {
        // Actualizo habitacion, fecha, medico o paciente del ingreso mediante PUT
        $response = $this->apiWrite('put', "ingresos/{$codigo}", $request->only([
            'habitacion', 'fecha', 'codigo_medico', 'codigo_paciente',
        ]));

        if ($response->successful()) {
            return redirect()->route('ingresos.index')->with('success', 'Ingreso actualizado correctamente.');
        }

        return back()->withInput()->withErrors($response->json('errors') ?? ['error' => $response->json('message') ?? 'Error al actualizar el ingreso.']);
    }

    public function destroy($codigo)
    {
        $response = $this->apiWrite('delete', "ingresos/{$codigo}");

        if ($response->successful()) {
            return redirect()->route('ingresos.index')->with('success', 'Ingreso eliminado correctamente.');
        }

        return redirect()->route('ingresos.index')->with('error', $response->json('message') ?? 'No se pudo eliminar el ingreso.');
    }
}