<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        /// seeder para los roles y permisos     admin, doctores, paciente, usuarios

        $admin = Role::create(['name' => 'admin']);
        $doctor = Role::create(['name' => 'doctor']);
        $paciente = Role::create(['name' => 'paciente']);
        $usuario = Role::create(['name' => 'usuario']);


        User::create([
            'name' => 'Administrador',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345678')
        ])->assignRole('admin');

        User::create([
            'name' => 'Doctor1',
            'email' => 'doctor1@admin.com',
            'password' => Hash::make('12345678')
        ])->assignRole('doctor');
        User::create([
            'name' => 'usuario1',
            'email' => 'usuario1@admin.com',
            'password' => Hash::make('12345678')
        ])->assignRole('usuario');

        User::create([
            'name' => 'Paciente1',
            'email' => 'paciente1@admin.com',
            'password' => Hash::make('12345678')
        ])->assignRole('paciente');


        $this->call([Pacienteseeder::class]);



        // Permisos para el módulo de pacientes
        Permission::create(['name' => 'pacientes.lista'])->syncRoles([$admin]);
        Permission::create(['name' => 'paciente.ver'])->syncRoles([$admin]);
        Permission::create(['name' => 'paciente.registrar'])->syncRoles([$admin]);
        Permission::create(['name' => 'paciente.editar'])->syncRoles([$admin]);
        Permission::create(['name' => 'paciente.editar.registro'])->syncRoles([$admin]);

        // Permisos para el módulo de consultorios
        Permission::create(['name' => 'consultorios.lista'])->syncRoles([$admin]);
        Permission::create(['name' => 'consultorio.registrar'])->syncRoles([$admin]);
        Permission::create(['name' => 'consultorio.registrar.form'])->syncRoles([$admin]);

        // Permisos para el módulo de doctores
        Permission::create(['name' => 'doctores.lista'])->syncRoles([$admin]);
        Permission::create(['name' => 'doctor.registrar'])->syncRoles([$admin]);
        Permission::create(['name' => 'doctor.registrar.form'])->syncRoles([$admin]);

        // Permisos para el módulo de horarios
        Permission::create(['name' => 'horarios.lista'])->syncRoles([$admin]);
        Permission::create(['name' => 'horario.registrar'])->syncRoles([$admin]);
        Permission::create(['name' => 'horario.registrar.form'])->syncRoles([$admin]);
        Permission::create(['name' => 'horarios.cargar_datos_consultorios'])->syncRoles([$admin]);

        // Permisos para el módulo de usuarios
        Permission::create(['name' => 'usuarios.index'])->syncRoles([$admin]);
        Permission::create(['name' => 'usuarios.registro'])->syncRoles([$admin]);
        Permission::create(['name' => 'usuarios.registro.form'])->syncRoles([$admin]);

        Permission::create(['name' => 'horarios.cargar_datos_consultoriosUser'])->syncRoles([$admin, $usuario]);

        // Permisos para reservas
        Permission::create(['name' => 'cargar_reserva_doctores'])->syncRoles([$admin, $usuario]);
        Permission::create(['name' => 'ver_reserva'])->syncRoles([$admin, $usuario]);
        Permission::create(['name' => 'registrocita'])->syncRoles([$admin, $usuario]);

    }
}
