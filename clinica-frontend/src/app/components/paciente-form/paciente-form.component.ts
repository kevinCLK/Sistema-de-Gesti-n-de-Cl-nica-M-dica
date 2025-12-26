import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormBuilder, FormGroup, ReactiveFormsModule, Validators } from '@angular/forms';
import { ActivatedRoute, Router, RouterModule } from '@angular/router';
import { MatFormFieldModule } from '@angular/material/form-field';
import { MatInputModule } from '@angular/material/input';
import { MatDatepickerModule } from '@angular/material/datepicker';
import { MatNativeDateModule } from '@angular/material/core';
import { MatButtonModule } from '@angular/material/button';
import { MatIconModule } from '@angular/material/icon';
import { MatSnackBar, MatSnackBarModule } from '@angular/material/snack-bar';

import { PacienteService } from '../../services/paciente.service';

@Component({
  selector: 'app-paciente-form',
  standalone: true,
  imports: [
    CommonModule,
    RouterModule,
    ReactiveFormsModule,
    MatFormFieldModule,
    MatInputModule,
    MatDatepickerModule,
    MatNativeDateModule,
    MatButtonModule,
    MatIconModule,
    MatSnackBarModule
  ],
  templateUrl: './paciente-form.component.html',
  styleUrls: ['./paciente-form.component.scss']
})
export class PacienteFormComponent implements OnInit {
  pacienteForm: FormGroup;
  isEditMode = false;
  pacienteId: number | null = null;
  pageTitle = 'Registrar Nuevo Paciente';

  constructor(
    private fb: FormBuilder,
    private pacienteService: PacienteService,
    private router: Router,
    private route: ActivatedRoute,
    private snackBar: MatSnackBar
  ) {
    this.pacienteForm = this.fb.group({
      nombre: ['', Validators.required],
      apellidos: ['', Validators.required],
      ci: ['', Validators.required],
      fecha_nacimiento: [''],
      grupo_sanguineo: [''],
      alergias: [''],
      celular: [''],
      correo: ['', Validators.email],
      direccion: [''],
      contacto_emergencia_nombre: [''],
      contacto_emergencia_celular: [''],
    });
  }

  ngOnInit(): void {
    const id = this.route.snapshot.paramMap.get('id');
    if (id) {
      this.isEditMode = true;
      this.pacienteId = +id;
      this.pageTitle = 'Editar Paciente';
      this.loadPacienteData(this.pacienteId);
    }
  }

  loadPacienteData(id: number): void {
    this.pacienteService.getPaciente(id).subscribe({
      next: (paciente) => {
        this.pacienteForm.patchValue(paciente);
      },
      error: (err) => {
        console.error('Error al cargar datos del paciente', err);
        this.snackBar.open('Error al cargar los datos del paciente.', 'Cerrar', { duration: 3000 });
        this.router.navigate(['/pacientes']);
      }
    });
  }

  onSubmit(): void {
    if (this.pacienteForm.invalid) {
      return; // Si el formulario es inválido, no hacer nada
    }

    const formData = this.pacienteForm.value;
    const action = this.isEditMode && this.pacienteId
      ? this.pacienteService.updatePaciente(this.pacienteId, formData)
      : this.pacienteService.createPaciente(formData);

    const successMessage = this.isEditMode
      ? 'Paciente actualizado con éxito.'
      : 'Paciente creado con éxito.';

    action.subscribe({
      next: () => {
        this.snackBar.open(successMessage, 'Cerrar', { duration: 3000 });
        this.router.navigate(['/pacientes']);
      },
      error: (err) => {
        console.error('Error al guardar el paciente', err);
        this.snackBar.open('Error al guardar el paciente.', 'Cerrar', { duration: 3000 });
      }
    });
  }

  cancel(): void {
    this.router.navigate(['/pacientes']);
  }
}
