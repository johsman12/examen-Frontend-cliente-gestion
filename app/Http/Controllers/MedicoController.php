<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MedicoController extends Controller
{
    public function index()
    {
        // Consulto el listado de medicos desde la API
        $medicos = $this->apiGet('medicos') ?? [];
        return view('medicos.index', compact('medicos'));
    }

    public function create()
    {
        return view('medicos.create');
    }

    public function store(Request $request)
    {
        // Envío los datos del nuevo medico mediante POST a la API
        $response = $this->apiWrite('post', 'medicos', $request->only([
            'codigo_medico', 'nombre', 'apellidos',
        ]));

        if ($response->successful()) {
            return redirect()->route('medicos.index')->with('success', 'Médico registrado correctamente.');
        }

        // Si la API devuelve errores de validacion, los muestro en el formulario
        return back()->withInput()->withErrors($response->json('errors') ?? ['error' => $response->json('message') ?? 'Error al registrar el médico.']);
    }

    public function show($codigo)
    {
        // Consulto la informacion individual del medico y los ingresos que ha atendido
        $medico = $this->apiGet("medicos/{$codigo}");

        if (!$medico) {
            return redirect()->route('medicos.index')->with('error', 'Medico no encontrado.');
        }

        return view('medicos.show', compact('medico'));
    }

    public function edit($codigo)
    {
        $medico = $this->apiGet("medicos/{$codigo}");

        if (!$medico) {
            return redirect()->route('medicos.index')->with('error', 'Medico no encontrado.');
        }

        return view('medicos.edit', compact('medico'));
    }

    public function update(Request $request, $codigo)
    {
        // Envio la actualizacion del medico mediante PUT a la API
        $response = $this->apiWrite('put', "medicos/{$codigo}", $request->only([
            'nombre', 'apellidos',
        ]));

        if ($response->successful()) {
            return redirect()->route('medicos.index')->with('success', 'Médico actualizado correctamente.');
        }

        return back()->withInput()->withErrors($response->json('errors') ?? ['error' => $response->json('message') ?? 'Error al actualizar el médico.']);
    }

    public function destroy($codigo)
    {
        // Envioo la solicitud DELETE a la API; si tiene ingresos asociados, muestro el mensaje de integridad referencial
        $response = $this->apiWrite('delete', "medicos/{$codigo}");

        if ($response->successful()) {
            return redirect()->route('medicos.index')->with('success', 'Médico eliminado correctamente.');
        }

        return redirect()->route('medicos.index')->with('error', $response->json('message') ?? 'No se pudo eliminar el medico.');
    }
}