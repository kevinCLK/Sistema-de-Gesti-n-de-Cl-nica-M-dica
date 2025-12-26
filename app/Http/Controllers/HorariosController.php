<?php

namespace App\Http\Controllers;

use App\Models\config;
use App\Models\horarios;
use App\Models\doctores;
use App\Models\Consultorio;
use FPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HorariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $horario= horarios::with('doctor','consultorio')->get();
        $consultorios=Consultorio::all();
        return view('horarios.horarios_index',compact('horario','consultorios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function RegistroHorario()
    {
        $doctores=doctores::all();
        $consultorios=Consultorio::all();
        $horario= horarios::with('doctor','consultorio')->get();
        return view('horarios.registroHorarios',compact('doctores','consultorios','horario'));
    }
    public function cargar_datos_consultorios($id) {
        try {
            $horario = horarios::with('doctor', 'consultorio')->where('consultorio_id', $id)->get();
            return view('horarios.cargar_datos_consultorios', compact('horario'));
        } catch (\Exception $exception) {
            return response()->json(['mensaje' => 'Error']);
        }
    }
    



    public function RegistroHorarioForm(Request $request)
{
    // Validar los datos del formulario
    $request->validate([
        'dia' => 'required',
        'hora_inicio' => 'required|date_format:H:i',
        'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
        'consultorio_id' => 'required|exists:consultorios,id', // Validar que el consultorio exista
    ]);

    // Verificar si el horario ya existe para ese día, rango de horas y consultorio
    $horarioExistente = horarios::where('dia', $request->dia)
        ->where('consultorio_id', $request->consultorio_id) // Filtrar por consultorio
        ->where(function ($query) use ($request) {
            $query->where(function($query) use ($request) {
                $query->where('hora_inicio', '>=', $request->hora_inicio)
                    ->where('hora_inicio', '<', $request->hora_fin);
            })
            ->orWhere(function ($query) use ($request) {
                $query->where('hora_fin', '>', $request->hora_inicio)
                    ->where('hora_fin', '<=', $request->hora_fin);
            })
            ->orWhere(function ($query) use ($request) {
                $query->where('hora_inicio', '<', $request->hora_inicio)
                    ->where('hora_fin', '>', $request->hora_fin);
            });
        })
        ->exists();

    if ($horarioExistente) {
        return redirect()->back()
            ->withInput()
            ->with('mensaje', 'Ya existe un horario que se superpone con el horario ingresado para este consultorio')
            ->with('icono', 'error');
    }


    // Guardar el horario si no existe conflicto
    $obj = new horarios();
    $obj->dia = mb_strtoupper($request->post('dia'), 'utf-8');
    $obj->hora_inicio = $request->post('hora_inicio');
    $obj->hora_fin = $request->post('hora_fin');
    $obj->doctor_id = $request->post('doctor');
    $obj->consultorio_id = $request->post('consultorio_id');
    $obj->save();

    return response()->json([
        'success' => true,
        'message' => 'Horario registrado correctamente'
    ]);
}
public function generarReporteHorarios()
{
    $configuracion = config::latest()->first();
    $horarios = horarios::with(['doctor', 'consultorio'])->get(); // Asegúrate de que los modelos estén relacionados correctamente

    // Crear un nuevo PDF en formato apaisado (landscape)
    $pdf = new FPDF();
    $pdf->AddPage('L', ['216', '279']); // Tamaño de página en mm
    $pdf->SetFont('Arial', 'B', 14);

    // Encabezado con el logo y detalles de la clínica
    if ($configuracion->logo) {
        $pdf->Image(public_path('storage/' . $configuracion->logo), 210, 10, 30);
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
    $pdf->Cell(0, 10, 'Horarios Registrados', 0, 1, 'C');
    $pdf->SetFont('Arial', 'I', 12);
    $pdf->Cell(0, 10, 'Reporte generado el: ' . date('d/m/Y'), 0, 1, 'C');

    // Espaciado antes de la tabla
    $pdf->Ln(5);

    // Encabezados de la tabla
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetFillColor(230, 230, 230);
    $pdf->Cell(10, 10, '#', 1, 0, 'C', true);
    $pdf->Cell(50, 10, 'DOCTOR', 1, 0, 'C', true);
    $pdf->Cell(40, 10, 'ESPECIALIDAD', 1, 0, 'C', true);
    $pdf->Cell(60, 10, 'CONSULTORIO', 1, 0, 'C', true);
    $pdf->Cell(40, 10, 'DIA DE ATENCION', 1, 0, 'C', true);
    $pdf->Cell(30, 10, 'HORA INICIO', 1, 0, 'C', true);
    $pdf->Cell(30, 10, 'HORA FIN', 1, 1, 'C', true);

    // Filas de la tabla
    $pdf->SetFont('Arial', '', 10);
    foreach ($horarios as $index => $horario) {
        $pdf->Cell(10, 10, $index + 1, 1, 0, 'C');
        $pdf->Cell(50, 10, $horario->doctor->nombres . ' ' . $horario->doctor->apellidos, 1, 0, 'L');
        $pdf->Cell(40, 10, $horario->doctor->especialidad, 1, 0, 'L');
        $pdf->Cell(60, 10, $horario->consultorio->nombre . ' - ' . $horario->consultorio->ubicacion, 1, 0, 'L');
        $pdf->Cell(40, 10, $horario->dia, 1, 0, 'C');
        $pdf->Cell(30, 10, $horario->hora_inicio, 1, 0, 'C');
        $pdf->Cell(30, 10, $horario->hora_fin, 1, 1, 'C');
    }

    // Pie de página
    // Pie de página
    $pdf->Ln(10);
    $pdf->SetFont('Arial', 'I', 8);
    $pdf->Cell(0, 10, 'Clinica - Bella Vista.', 0, 0, 'C');

    // Descargar el PDF
    $pdf->Output('D', 'reporte_horarios.pdf');
}
public function eliminarhorario(Request $request){
    $idDoctor = $request->post('id');
    $obj = horarios::find($idDoctor);
    if ($obj->delete()) {
      return response()->json(['message' => 'Doctor eliminado con éxito', 'success' => true]);
    } else {
      return response()->json(['message' => 'Error al eliminar el doctor', 'success' => false]);
    }
  }

  public function editarHorario(Request $request)
{
    $idHorario = $request->post('id');

    // Obtener el horario
    $obj = DB::table('horarios')->where('id', '=', $idHorario)->first();

    // Obtener listas de doctores y consultorios
    $doctores = DB::table('doctores')->get();
    $consultorios = DB::table('consultorios')->get();

    return view('horarios.editarHorarios', compact('obj', 'doctores', 'consultorios'));
}

public function editarRegistroHorario(Request $request)
{
    $idHorario = $request->post('idHorario');

    $horario = DB::table('horarios')->where('id', '=', $idHorario)->update([
        'dia' => $request->post('dia'),
        'hora_inicio' => $request->post('hora_inicio'),
        'hora_fin' => $request->post('hora_fin'),
        'doctor_id' => $request->post('doctor_id'),
        'consultorio_id' => $request->post('consultorio_id'),
        'updated_at' => now(),
    ]);

    return response()->json(['success' => true]);
}




    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(horarios $horarios)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(horarios $horarios)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, horarios $horarios)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(horarios $horarios)
    {
        //
    }
}
