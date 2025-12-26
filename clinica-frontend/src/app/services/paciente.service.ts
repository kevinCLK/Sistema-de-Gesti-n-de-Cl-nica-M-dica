import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

// Interfaz que define la estructura del objeto Paciente, basada en API_CONTRACT.md
export interface Paciente {
  id: number;
  nombre: string;
  apellidos: string;
  ci: string;
  fecha_nacimiento?: string;
  grupo_sanguineo?: string;
  alergias?: string;
  celular?: string;
  correo?: string;
  direccion?: string;
  contacto_emergencia_nombre?: string;
  contacto_emergencia_celular?: string;
  created_at?: string;
  updated_at?: string;
}

@Injectable({
  providedIn: 'root'
})
export class PacienteService {
  // URL base de la API (apuntando al futuro backend de Laravel)
  private apiUrl = 'http://localhost:8000/api/pacientes';

  constructor(private http: HttpClient) { }

  /**
   * Obtiene la lista de todos los pacientes.
   * Corresponde a: GET /api/pacientes
   */
  getPacientes(): Observable<Paciente[]> {
    return this.http.get<Paciente[]>(this.apiUrl);
  }

  /**
   * Obtiene un paciente específico por su ID.
   * Corresponde a: GET /api/pacientes/{id}
   */
  getPaciente(id: number): Observable<Paciente> {
    return this.http.get<Paciente>(`${this.apiUrl}/${id}`);
  }

  /**
   * Registra un nuevo paciente.
   * Corresponde a: POST /api/pacientes
   */
  createPaciente(paciente: Omit<Paciente, 'id'>): Observable<Paciente> {
    return this.http.post<Paciente>(this.apiUrl, paciente);
  }

  /**
   * Actualiza un paciente existente.
   * Corresponde a: PUT /api/pacientes/{id}
   */
  updatePaciente(id: number, paciente: Partial<Paciente>): Observable<Paciente> {
    return this.http.put<Paciente>(`${this.apiUrl}/${id}`, paciente);
  }

  /**
   * Elimina un paciente.
   * Corresponde a: DELETE /api/pacientes/{id}
   */
  deletePaciente(id: number): Observable<void> {
    return this.http.delete<void>(`${this.apiUrl}/${id}`);
  }
}
