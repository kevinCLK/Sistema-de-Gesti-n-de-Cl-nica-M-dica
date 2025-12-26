<?php

namespace Database\Seeders;

use App\Models\Paciente;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Pacienteseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Paciente::factory()->count(20)->create()->each(function($user){
            $user->assignRole('paciente');
        });
    }
}
