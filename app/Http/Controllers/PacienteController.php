<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PacienteController extends Controller
{
    public function index()
    {
        // Consulto todos los pacientes desde la API
        $pacientes = $this->apiGet('pacientes') ?? [];
        return view('pacientes.index', compact('pacientes'));
    }

    public function create()
    {
        return view('pacientes.create');
    }

    public function store(Request $request)
    {
        $data = [
            'codigo_paciente' => $request->input('codigo_paciente'),
            'nombre'          => $request->input('nombre'),
            'apellidos'       => $request->input('apellidos'),
        ];

        // Envio los datos y la fotografia usando multipart/form-data
        $response = $this->apiWriteMultipart('pacientes', $data, $request->file('foto'), 'foto');

        if ($response->successful()) {
            return redirect()->route('pacientes.index')->with('success', 'Paciente registrado correctamente.');
        }

        return back()->withInput()->withErrors($response->json('errors') ?? ['error' => $response->json('message') ?? 'Error al registrar el paciente.']);
    }

    public function show($codigo)
    {
        // Consulto la informacion individual del paciente y su historial de ingresos
        $paciente = $this->apiGet("pacientes/{$codigo}");

        if (!$paciente) {
            return redirect()->route('pacientes.index')->with('error', 'Paciente no encontrado.');
        }

        return view('pacientes.show', compact('paciente'));
    }

    public function edit($codigo)
    {
        $paciente = $this->apiGet("pacientes/{$codigo}");

        if (!$paciente) {
            return redirect()->route('pacientes.index')->with('error', 'Paciente no encontrado.');
        }

        return view('pacientes.edit', compact('paciente'));
    }

    public function update(Request $request, $codigo)
    {
        $data = [
            'nombre'    => $request->input('nombre'),
            'apellidos' => $request->input('apellidos'),
        ];

        // Uso POST con multipart/form-data hacia /pacientes/{codigo} para permitir el reemplazo de fotografia
        $response = $this->apiWriteMultipart("pacientes/{$codigo}", $data, $request->file('foto'), 'foto');

        if ($response->successful()) {
            return redirect()->route('pacientes.index')->with('success', 'Paciente actualizado correctamente.');
        }

        return back()->withInput()->withErrors($response->json('errors') ?? ['error' => $response->json('message') ?? 'Error al actualizar el paciente.']);
    }

    public function destroy($codigo)
    {
        // Envio la solicitud DELETE a la API; si tiene ingresos asociados, muestro el error devuelto por el servidor
        $response = $this->apiWrite('delete', "pacientes/{$codigo}");

        if ($response->successful()) {
            return redirect()->route('pacientes.index')->with('success', 'Paciente eliminado correctamente.');
        }

        return redirect()->route('pacientes.index')->with('error', $response->json('message') ?? 'No se pudo eliminar el paciente.');
    }
}