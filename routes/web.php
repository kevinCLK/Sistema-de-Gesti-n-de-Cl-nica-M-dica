<?php

use App\Http\Controllers\ConfigController;
use App\Http\Controllers\Pruebascontroller;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\ConsultorioController;
use App\Http\Controllers\DoctoresController;
use App\Http\Controllers\eventoController;
use App\Http\Controllers\HorariosController;
use App\Http\Controllers\userController;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|


Route::get('/', function () {
    return view('welcome');
});
*/
Route::get('/', [Pruebascontroller::class, 'index'])->name('home');
Route::get('/panel', [Pruebascontroller::class, 'index_panelP'])->name('panel')->middleware('auth');
Route::get('/indexC', [Pruebascontroller::class, 'index_C'])->name('indexC');
Route::get('/login', [Pruebascontroller::class, 'login'])->name('login')->middleware('guest');
Route::post('/logout', [Pruebascontroller::class, 'logout'])->name('logout');
Route::get('/registro', [Pruebascontroller::class, 'registro'])->name('registro');
Route::post('/formRegistroUsuario', [Pruebascontroller::class, 'formRegistroUsuario'])->name('formRegistroUsuario');
Route::post('/login', [Pruebascontroller::class, 'loginAuth'])->name('login.auth');

Route::get('horarios/consultorio/{id}', [HorariosController::class, 'cargar_datos_consultorios'])->name('horarios.cargar_datos_consultoriosUser')->middleware(['auth', 'can:horarios.cargar_datos_consultoriosUser']);
Route::get( '/cargar_reserva_doctores/{id}', [Pruebascontroller::class, 'cargar_reserva_doctores'])->name( 'cargar_reserva_doctores')->middleware(['auth', 'can:cargar_reserva_doctores']);
Route::get( '/ver_reservas/{id}', [Pruebascontroller::class, 'ver_reservas'])->name( 'ver_reserva')->middleware(['auth', 'can:ver_reserva']);
Route::post('/registrocita', [eventoController::class, 'registrocita'])->name('registrocita')->middleware(['auth', 'can:registrocita']);
Route::get('/evento/{id}/editar', [EventoController::class, 'editarEvento'])->name('evento.editar');
// Ruta para procesar la actualización del evento
Route::post('/evento/editar', [EventoController::class, 'editarRegistroEvento'])->name('evento.actualizar');


//rutas para las configuraciones
    Route::get('/listaconfig', [ConfigController::class, 'index'])->name('config.lista');
    Route::get('/regconfig', [ConfigController::class, 'configreg'])->name('config.reg');
    Route::post('/RegistroConfig', [ConfigController::class, 'RegistroConfig'])->name('config.registro');


// Rutas para Pacientes
Route::get('/listaPacientes', [PacienteController::class, 'index'])->name('pacientes.lista')->middleware(['auth', 'can:pacientes.lista']);
Route::get('/verPaciente', [PacienteController::class, 'verpaciente'])->name('paciente.ver')->middleware(['auth', 'can:paciente.ver']);
Route::post('/NuevoRegistroPaciente', [PacienteController::class, 'NuevoRegistroPaciente'])->name('paciente.registrar')->middleware(['auth', 'can:paciente.registrar']);
Route::post('/editarPaciente', [PacienteController::class, 'editarPaciente'])->name('paciente.editar')->middleware(['auth', 'can:paciente.editar']);
Route::post('/editarRegistroPaciente', [PacienteController::class, 'editarRegistroPaciente'])->name('paciente.editar.registro')->middleware(['auth', 'can:paciente.editar.registro']);
Route::get('/generarReportePacientes', [PacienteController::class, 'generarReportePacientes'])->name('generarReportePacientes');
Route::post('/eliminarpaciente', [PacienteController::class, 'eliminarpaciente']);



// Rutas para Consultorios
Route::get('/listaConsultorio', [ConsultorioController::class, 'index'])->name('consultorios.lista')->middleware(['auth', 'can:consultorios.lista']);
Route::get('/consultorioreg', [ConsultorioController::class, 'consultorioreg'])->name('consultorio.registrar')->middleware(['auth', 'can:consultorio.registrar']);
Route::post('/RegistroConsultorio', [ConsultorioController::class, 'RegistroConsultorio'])->name('consultorio.registrar.form')->middleware(['auth', 'can:consultorio.registrar.form']);
Route::get('/generarReporteConsultorios', [ConsultorioController::class, 'generarReporteConsultorios'])->name('generarReporteConsultorios');
Route::post('/eliminarconsultorio', [ConsultorioController::class, 'eliminarconsultorio']);
Route::post('/editarConsultorio', [ConsultorioController::class, 'editarConsultorio']);
Route::post('/editarRegistroConsultorio', [ConsultorioController::class, 'editarRegistroConsultorio']);



// Rutas para Doctores
Route::get('/listaDoctores', [DoctoresController::class, 'index'])->name('doctores.lista')->middleware(['auth', 'can:doctores.lista']);
Route::get('/RegistroDoctor', [DoctoresController::class, 'RegistroDoctor'])->name('doctor.registrar')->middleware(['auth', 'can:doctor.registrar']);
Route::post('/RegistroDoctorform', [DoctoresController::class, 'RegistroDoctorform'])->name('doctor.registrar.form')->middleware(['auth', 'can:doctor.registrar.form']);
Route::get('/reporte-doctores', [DoctoresController::class, 'generarReporteDoctores'])->name('generarReporteDoctores');
Route::post('/eliminarDoctor', [DoctoresController::class, 'eliminarDoctor']);
Route::post('/editarDoctor', [DoctoresController::class, 'editarDoctor']);
Route::post('/editarRegistroDoctor', [DoctoresController::class, 'editarRegistroDoctor']);


// Rutas para Horarios
Route::get('/listaHorarios', [HorariosController::class, 'index'])->name('horarios.lista')->middleware(['auth', 'can:horarios.lista']);
Route::get('/RegistroHorario', [HorariosController::class, 'RegistroHorario'])->name('horario.registrar')->middleware(['auth', 'can:horario.registrar']);
Route::post('/RegistroHorarioForm', [HorariosController::class, 'RegistroHorarioForm'])->name('horario.registrar.form')->middleware(['auth', 'can:horario.registrar.form']);
Route::get('horarios/consultorios/{id}', [HorariosController::class, 'cargar_datos_consultorios'])->name('horarios.cargar_datos_consultorios')->middleware(['auth', 'can:horarios.cargar_datos_consultorios']);
Route::get('/generarReporteHorarios', [HorariosController::class, 'generarReporteHorarios'])->name('generarReporteHorarios');
Route::post('/eliminarhorario', [HorariosController::class, 'eliminarhorario']);
Route::post('/editarHorario', [HorariosController::class, 'editarHorario']);
Route::post('/editarRegistroHorario', [HorariosController::class, 'editarRegistroHorario']);



// Rutas para Usuarios
Route::get('/usuarios', [userController::class, 'index'])->name('usuarios.index')->middleware(['auth', 'can:usuarios.index']);
Route::get('/registroUsuario', [userController::class, 'registro'])->name('usuarios.registro')->middleware(['auth', 'can:usuarios.registro']);
Route::post('/registroUsuario', [userController::class, 'registroNuevouser'])->name('usuarios.registro.from')->middleware(['auth', 'can:usuarios.registro.form']);
Route::post('/eliminarUser', [userController::class, 'eliminarUser']);
Route::post('/editaruser', [userController::class, 'editaruser']);
Route::post('/editarRegistroUser', [userController::class, 'editarRegistroUser']);

