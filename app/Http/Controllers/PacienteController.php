<?php

namespace App\Http\Controllers;

use App\Models\config;
use App\Models\Paciente;
use FPDF;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\DB as FacadesDB;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pacientes = Paciente::all();
        return view('Paciente.paciente_index', compact('pacientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function verpaciente()
    {

        return view('Paciente.registroPaciente');
    }
    public function NuevoRegistroPaciente(Request $request)
    {
        $obj = new Paciente();
        $obj->nombre = mb_strtoupper($request->post('nombre'), 'utf-8');
        $obj->apellidos = mb_strtoupper($request->post('apellidos'), 'utf-8');
        $obj->ci = $request->post('ci');
        $obj->num_seguro = $request->post('num_seguro');
        $obj->fecha_nacimiento = $request->post('fecha_nacimiento');
        $obj->genero = $request->post('genero');
        $obj->celular = $request->post('celular');
        $obj->correo = mb_strtolower($request->post('correo'), 'utf-8');
        $obj->direccion = mb_strtoupper($request->post('direccion'), 'utf-8');
        $obj->grupo_sanguineo = $request->post('grupo_sanguineo');
        $obj->alergias = mb_strtoupper($request->post('alergias'), 'utf-8');
        $obj->contacto_emegencia = mb_strtoupper($request->post('contacto_emegencia'), 'utf-8');
        $obj->observaciones = mb_strtoupper($request->post('observaciones'), 'utf-8');
        $obj->save();
    }
    public function editarPaciente(Request $request)
    {
        $idpaciente = $request->post('id');
        $obj = DB::table("pacientes")->where('id', '=', $idpaciente)->first();

        return view('Paciente.editarPaciente', compact('obj'));
    }
    public function editarRegistroPaciente(Request $request)
    {
        // Obtener el ID del paciente desde el request
        $idPaciente = $request->post('idPaciente');
        $obj = Paciente::find($idPaciente);
        $obj->ci = $request->post('ci');
        $obj->num_seguro = $request->post('num_seguro');
        $obj->nombre = mb_strtoupper($request->post('nombre'), 'utf-8');
        $obj->apellidos = mb_strtoupper($request->post('apellidos'), 'utf-8');
        $obj->celular = $request->post('celular');
        $obj->fecha_nacimiento = $request->post('fecha_nacimiento');
        $obj->genero = $request->post('genero');
        $obj->correo = mb_strtolower($request->post('correo'), 'utf-8');
        $obj->direccion = mb_strtoupper($request->post('direccion'), 'utf-8');
        $obj->grupo_sanguineo = $request->post('grupo_sanguineo');
        $obj->alergias = mb_strtoupper($request->post('alergias'), 'utf-8');
        $obj->contacto_emegencia = mb_strtoupper($request->post('contacto_emegencia'), 'utf-8');
        $obj->observaciones = mb_strtoupper($request->post('observaciones'), 'utf-8');
        $obj->save();
    }
    public function generarReportePacientes()
    {
        $configuracion = config::latest()->first();
        $pacientes = Paciente::all();

        // Crear un nuevo PDF en formato apaisado (landscape)
        $pdf = new FPDF();
        $pdf->AddPage('L', ['270', '300']); // Tamaño de página en mm
        $pdf->SetFont('Arial', 'B', 14);

        // Encabezado con el logo y detalles de la clínica
        if ($configuracion->logo) {
            $pdf->Image(public_path('storage/' . $configuracion->logo), 250, 10, 30);
        }

        $pdf->SetXY(10, 10);
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 8, $configuracion->nombre, 0, 1, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(0, 6, $configuracion->direccion, 0, 1, 'L');
        $pdf->Cell(0, 6, "Tel: " . $configuracion->telefono . " - Email: " . $configuracion->correo, 0, 1, 'L');

        // Título del reporte
        $pdf->Ln(10);
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 10, 'Listado de Pacientes', 0, 1, 'C');
        $pdf->SetFont('Arial', 'I', 12);
        $pdf->Cell(0, 10, 'Reporte generado el: ' . date('d/m/Y'), 0, 1, 'C');

        // Espaciado antes de la tabla
        $pdf->Ln(5);

        // Encabezados de la tabla
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetFillColor(230, 230, 230);

        // Reorganizamos las columnas para que se vean bien
        $pdf->Cell(10, 10, 'Nro', 1, 0, 'C', true);  // Nro
        $pdf->Cell(60, 10, 'Nombres y Apellidos', 1, 0, 'C', true);  // Nombres y Apellidos
        $pdf->Cell(25, 10, 'CI', 1, 0, 'C', true);  // CI
        $pdf->Cell(30, 10, 'Fecha Nacimiento', 1, 0, 'C', true);  // Fecha de nacimiento
        $pdf->Cell(20, 10, 'Genero', 1, 0, 'C', true);  // Género
        $pdf->Cell(30, 10, 'Celular', 1, 0, 'C', true);  // Celular
        $pdf->Cell(40, 10, 'Email', 1, 0, 'C', true);  // Email
        $pdf->Cell(60, 10, 'Direccion', 1, 1, 'C', true);  // Dirección

        // Filas de la tabla
        $pdf->SetFont('Arial', '', 10);
        foreach ($pacientes as $index => $paciente) {
            $pdf->Cell(10, 10, $index + 1, 1, 0, 'C');
            $pdf->Cell(60, 10, $paciente->nombre . ' ' . $paciente->apellidos, 1, 0, 'L');
            $pdf->Cell(25, 10, $paciente->ci, 1, 0, 'C');
            $pdf->Cell(30, 10, $paciente->fecha_nacimiento, 1, 0, 'C');
            $pdf->Cell(20, 10, $paciente->genero, 1, 0, 'C');
            $pdf->Cell(30, 10, $paciente->celular, 1, 0, 'C');
            $pdf->Cell(40, 10, $paciente->correo, 1, 0, 'L');
            $pdf->Cell(60, 10, $paciente->direccion, 1, 1, 'L');
        }

        // Pie de página
        $pdf->Ln(10);
        $pdf->SetFont('Arial', 'I', 8);
        $pdf->Cell(0, 10, 'Clinica - Bella Vista.', 0, 0, 'C');

        // Descargar el PDF
        $pdf->Output('D', 'reporte_pacientes.pdf');
    }
    public function eliminarpaciente(Request $request){
        $idDoctor = $request->post('id');
        $obj = Paciente::find($idDoctor);
        if ($obj->delete()) {
          return response()->json(['message' => 'Paciente eliminado con éxito', 'success' => true]);
        } else {
          return response()->json(['message' => 'Error al eliminar el doctor', 'success' => false]);
        }
      }
    
    }
    




