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

import { Paciente, PacienteService } from '../../services/paciente.service';
import { of } from 'rxjs';

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
    MatIconModule
  ],
  templateUrl: './paciente-form.component.html',
  styleUrls: ['./paciente-form.component.scss']
})
export class PacienteFormComponent implements OnInit {
  pacienteForm: FormGroup;
  isEditMode = false;
  pacienteId: number | null = null;

  constructor(
    private fb: FormBuilder,
    private pacienteService: PacienteService,
    private router: Router,
    private route: ActivatedRoute
  ) {
    this.pacienteForm = this.fb.group({
      nombre: ['', Validators.required],
      apellidos: ['', Validators.required],
      ci: ['', Validators.required],
      fecha_nacimiento: [''],
      celular: [''],
      correo: ['', Validators.email],
      // Añade aquí el resto de los campos del formulario
    });
  }

  ngOnInit(): void {
    const id = this.route.snapshot.paramMap.get('id');
    if (id) {
      this.isEditMode = true;
      this.pacienteId = +id;
      this.loadPacienteData(this.pacienteId);
    }
  }

  loadPacienteData(id: number): void {
    // Simulación de la carga de datos para el modo edición
    const mockPaciente: Paciente = { id: 1, nombre: 'Juan', apellidos: 'Pérez Gómez', ci: '1234567 LP', celular: '77712345', correo: 'juan.perez@example.com' };
    of(mockPaciente).subscribe(paciente => {
      this.pacienteForm.patchValue(paciente);
    });
    // En un caso real:
    // this.pacienteService.getPaciente(id).subscribe(paciente => {
    //   this.pacienteForm.patchValue(paciente);
    // });
  }

  onSubmit(): void {
    if (this.pacienteForm.invalid) {
      return; // Si el formulario es inválido, no hacer nada
    }

    const formData = this.pacienteForm.value;

    if (this.isEditMode && this.pacienteId) {
      // Lógica de actualización (simulada)
      console.log('Actualizando paciente:', this.pacienteId, formData);
      // this.pacienteService.updatePaciente(this.pacienteId, formData).subscribe(() => {
      //   this.router.navigate(['/pacientes']);
      // });
    } else {
      // Lógica de creación (simulada)
      console.log('Creando nuevo paciente:', formData);
      // this.pacienteService.createPaciente(formData).subscribe(() => {
      //   this.router.navigate(['/pacientes']);
      // });
    }
    // Como la lógica real está comentada, navegamos directamente
    this.router.navigate(['/pacientes']);
  }

  cancel(): void {
    this.router.navigate(['/pacientes']);
  }
}
