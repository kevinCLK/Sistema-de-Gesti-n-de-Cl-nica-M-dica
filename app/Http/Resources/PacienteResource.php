<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PacienteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'apellidos' => $this->apellidos,
            'ci' => $this->ci,
            'fecha_nacimiento' => $this->fecha_nacimiento,
            'grupo_sanguineo' => $this->grupo_sanguineo,
            'alergias' => $this->alergias,
            'celular' => $this->celular,
            'correo' => $this->correo,
            'direccion' => $this->direccion,
            'contacto_emergencia_nombre' => $this->contacto_emergencia_nombre,
            'contacto_emergencia_celular' => $this->contacto_emergencia_celular,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
