import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterModule } from '@angular/router';
import { MatTableModule } from '@angular/material/table';
import { MatButtonModule } from '@angular/material/button';
import { MatIconModule } from '@angular/material/icon';
import { MatSnackBar, MatSnackBarModule } from '@angular/material/snack-bar';

import { Paciente, PacienteService } from '../../services/paciente.service';

@Component({
  selector: 'app-pacientes-list',
  standalone: true,
  imports: [
    CommonModule,
    RouterModule,
    MatTableModule,
    MatButtonModule,
    MatIconModule,
    MatSnackBarModule
  ],
  templateUrl: './pacientes-list.component.html',
  styleUrls: ['./pacientes-list.component.scss']
})
export class PacientesListComponent implements OnInit {
  // Columnas que se mostrarán en la tabla
  displayedColumns: string[] = ['nombreCompleto', 'ci', 'celular', 'acciones'];
  pacientes: Paciente[] = [];

  constructor(
    private pacienteService: PacienteService,
    private snackBar: MatSnackBar
  ) { }

  ngOnInit(): void {
    this.loadPacientes();
  }

  loadPacientes(): void {
    this.pacienteService.getPacientes().subscribe({
      next: (data) => {
        this.pacientes = data;
      },
      error: (err) => {
        console.error('Error al cargar pacientes', err);
        this.snackBar.open('Error al cargar la lista de pacientes.', 'Cerrar', { duration: 3000 });
      }
    });
  }

  deletePaciente(id: number): void {
    if (confirm('¿Está seguro de que desea eliminar este paciente?')) {
      this.pacienteService.deletePaciente(id).subscribe({
        next: () => {
          this.snackBar.open('Paciente eliminado con éxito.', 'Cerrar', { duration: 3000 });
          this.loadPacientes(); // Recargar la lista
        },
        error: (err) => {
          console.error('Error al eliminar paciente', err);
          this.snackBar.open('Error al eliminar el paciente.', 'Cerrar', { duration: 3000 });
        }
      });
    }
  }
}
