<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePacienteRequest;
use App\Http\Requests\UpdatePacienteRequest;
use App\Http\Resources\PacienteResource;
use App\Models\Paciente;

class PacienteApiController extends Controller
{
    /**
     * Muestra una lista de los pacientes.
     */
    public function index()
    {
        return PacienteResource::collection(Paciente::all());
    }

    /**
     * Guarda un nuevo paciente en la base de datos.
     */
    public function store(StorePacienteRequest $request)
    {
        $paciente = Paciente::create($request->validated());

        return new PacienteResource($paciente);
    }

    /**
     * Muestra un paciente específico.
     */
    public function show(Paciente $paciente)
    {
        return new PacienteResource($paciente);
    }

    /**
     * Actualiza un paciente existente.
     */
    public function update(UpdatePacienteRequest $request, Paciente $paciente)
    {
        $paciente->update($request->validated());

        return new PacienteResource($paciente);
    }

    /**
     * Elimina un paciente.
     */
    public function destroy(Paciente $paciente)
    {
        $paciente->delete();

        return response()->noContent();
    }
}
