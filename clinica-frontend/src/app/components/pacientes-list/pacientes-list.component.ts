import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterModule } from '@angular/router';
import { MatTableModule } from '@angular/material/table';
import { MatButtonModule } from '@angular/material/button';
import { MatIconModule } from '@angular/material/icon';

import { Paciente, PacienteService } from '../../services/paciente.service';
import { of } from 'rxjs';

@Component({
  selector: 'app-pacientes-list',
  standalone: true,
  imports: [
    CommonModule,
    RouterModule,
    MatTableModule,
    MatButtonModule,
    MatIconModule
  ],
  templateUrl: './pacientes-list.component.html',
  styleUrls: ['./pacientes-list.component.scss']
})
export class PacientesListComponent implements OnInit {
  // Columnas que se mostrarán en la tabla
  displayedColumns: string[] = ['nombreCompleto', 'ci', 'celular', 'acciones'];
  pacientes: Paciente[] = [];

  constructor(private pacienteService: PacienteService) { }

  ngOnInit(): void {
    this.loadPacientes();
  }

  loadPacientes(): void {
    // Nota: Como el backend aún no está conectado, usamos `of()` de RxJS
    // para simular una respuesta de la API con datos de ejemplo.
    // Cuando el backend esté listo, cambiaremos esto por:
    // this.pacienteService.getPacientes().subscribe(data => {
    //   this.pacientes = data;
    // });

    const mockPacientes: Paciente[] = [
      { id: 1, nombre: 'Juan', apellidos: 'Pérez Gómez', ci: '1234567 LP', celular: '77712345' },
      { id: 2, nombre: 'Ana', apellidos: 'García Soliz', ci: '7654321 CB', celular: '77754321' },
      { id: 3, nombre: 'Carlos', apellidos: 'Mendoza Roca', ci: '9876543 SC', celular: '77798765' }
    ];

    of(mockPacientes).subscribe(data => {
      this.pacientes = data;
    });
  }

  deletePaciente(id: number): void {
    // Lógica para eliminar un paciente.
    // Por ahora, solo mostraremos una alerta y lo filtraremos de la lista local.
    if (confirm('¿Está seguro de que desea eliminar este paciente?')) {
      this.pacientes = this.pacientes.filter(p => p.id !== id);
      // this.pacienteService.deletePaciente(id).subscribe(() => {
      //   this.loadPacientes(); // Recargar la lista
      // });
    }
  }
}
