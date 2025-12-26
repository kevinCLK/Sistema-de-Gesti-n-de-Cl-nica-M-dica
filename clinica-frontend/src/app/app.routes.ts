import { Routes } from '@angular/router';
import { PacientesListComponent } from './components/pacientes-list/pacientes-list.component';
import { PacienteFormComponent } from './components/paciente-form/paciente-form.component';

export const routes: Routes = [
  // Ruta para mostrar la lista de pacientes
  {
    path: 'pacientes',
    component: PacientesListComponent
  },
  // Ruta para registrar un nuevo paciente
  {
    path: 'pacientes/nuevo',
    component: PacienteFormComponent
  },
  // Ruta para editar un paciente existente
  {
    path: 'pacientes/editar/:id',
    component: PacienteFormComponent
  },
  // Redirige la ruta raíz a la lista de pacientes
  {
    path: '',
    redirectTo: '/pacientes',
    pathMatch: 'full'
  },
  // Ruta comodín para redirigir a los pacientes si no se encuentra la URL
  {
    path: '**',
    redirectTo: '/pacientes'
  }
];
