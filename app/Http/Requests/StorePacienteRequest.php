<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePacienteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // En un escenario real, aquí podrías verificar los permisos del usuario.
        // Por ahora, lo dejamos en true para permitir la creación.
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'ci' => 'required|string|max:255|unique:pacientes',
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
