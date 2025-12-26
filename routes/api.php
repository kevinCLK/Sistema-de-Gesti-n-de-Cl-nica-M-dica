<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PacienteApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Rutas para el recurso de Pacientes
// Esto crea automáticamente las siguientes rutas:
// GET /api/pacientes -> index()
// GET /api/pacientes/{paciente} -> show()
// POST /api/pacientes -> store()
// PUT /api/pacientes/{paciente} -> update()
// DELETE /api/pacientes/{paciente} -> destroy()
Route::apiResource('pacientes', PacienteApiController::class);
