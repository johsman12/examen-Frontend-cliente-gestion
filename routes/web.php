<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\IngresoController;
use App\Http\Controllers\HistorialController;

// Página principal (HOME)
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Gestión de Medicos
Route::get('/medicos', [MedicoController::class, 'index'])->name('medicos.index');
Route::get('/medicos/create', [MedicoController::class, 'create'])->name('medicos.create');
Route::post('/medicos', [MedicoController::class, 'store'])->name('medicos.store');
Route::get('/medicos/{codigo}', [MedicoController::class, 'show'])->name('medicos.show');
Route::get('/medicos/{codigo}/edit', [MedicoController::class, 'edit'])->name('medicos.edit');
Route::put('/medicos/{codigo}', [MedicoController::class, 'update'])->name('medicos.update');
Route::delete('/medicos/{codigo}', [MedicoController::class, 'destroy'])->name('medicos.destroy');

// Gestión de Pacientes
Route::get('/pacientes', [PacienteController::class, 'index'])->name('pacientes.index');
Route::get('/pacientes/create', [PacienteController::class, 'create'])->name('pacientes.create');
Route::post('/pacientes', [PacienteController::class, 'store'])->name('pacientes.store');
Route::get('/pacientes/{codigo}', [PacienteController::class, 'show'])->name('pacientes.show');
Route::get('/pacientes/{codigo}/edit', [PacienteController::class, 'edit'])->name('pacientes.edit');
Route::put('/pacientes/{codigo}', [PacienteController::class, 'update'])->name('pacientes.update');
Route::delete('/pacientes/{codigo}', [PacienteController::class, 'destroy'])->name('pacientes.destroy');

// Gestión de Ingresos
Route::get('/ingresos', [IngresoController::class, 'index'])->name('ingresos.index');
Route::get('/ingresos/create', [IngresoController::class, 'create'])->name('ingresos.create');
Route::post('/ingresos', [IngresoController::class, 'store'])->name('ingresos.store');
Route::get('/ingresos/{codigo}', [IngresoController::class, 'show'])->name('ingresos.show');
Route::get('/ingresos/{codigo}/edit', [IngresoController::class, 'edit'])->name('ingresos.edit');
Route::put('/ingresos/{codigo}', [IngresoController::class, 'update'])->name('ingresos.update');
Route::delete('/ingresos/{codigo}', [IngresoController::class, 'destroy'])->name('ingresos.destroy');

// Historial / Consultas por medico y paciente
Route::get('/historial', [HistorialController::class, 'index'])->name('historial.index');