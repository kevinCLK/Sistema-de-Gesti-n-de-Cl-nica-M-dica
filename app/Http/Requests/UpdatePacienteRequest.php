<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePacienteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Obtenemos el ID del paciente de la ruta
        $pacienteId = $this->route('paciente')->id;

        return [
            'nombre' => 'sometimes|required|string|max:255',
            'apellidos' => 'sometimes|required|string|max:255',
            'ci' => 'sometimes|required|string|max:255|unique:pacientes,ci,' . $pacienteId,
            'fecha_nacimiento' => 'nullable|date',
            'grupo_sanguineo' => 'nullable|string|max:10',
            'alergias' => 'nullable|string',
            'celular' => 'nullable|string|max:255',
            'correo' => 'nullable|email|max:255',
            'direccion' => 'nullable|string|max:255',
            'contacto_emergencia_nombre' => 'nullable|string|max:255',
            'contacto_emergencia_celular' => 'nullable|string|max:255',
        ];
    }
}
