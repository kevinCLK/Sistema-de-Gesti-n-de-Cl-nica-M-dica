<?php

namespace App\Http\Controllers;

use App\Models\config;
use App\Models\Consultorio;
use FPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConsultorioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $consultorios = Consultorio::all();
        return view('consultorios.consultorio_index',compact('consultorios'));
    }

    public function consultorioreg()
    {
        return view('consultorios.registroConsultorio');
    }

    public function RegistroConsultorio(Request $request)
    {
        $obj = new Consultorio();
        $obj->nombre = mb_strtoupper($request->post('nombre'), 'utf-8');
        $obj->ubicacion = mb_strtoupper($request->post('ubicacion'), 'utf-8');
        $obj->capacidad = $request->post('capacidad');
        $obj->telefono = $request->post('telefono');
        $obj->especialidad = mb_strtoupper($request->post('especialidad'), 'utf-8');
        $obj->estado = mb_strtoupper($request->post('estado'), 'utf-8');
        $obj->save();
    }

    public function generarReporteConsultorios()
{
    $configuracion = config::latest()->first();
    $consultorios = Consultorio::all();

    // Crear un nuevo PDF en formato apaisado (landscape)
    $pdf = new FPDF();
    $pdf->AddPage('L', ['216', '279']); // Tamaño de página en mm
    $pdf->SetFont('Arial', 'B', 14);

    // Encabezado con el logo y detalles de la clínica
    if ($configuracion->logo) {
        $pdf->Image(public_path('storage/' . $configuracion->logo), 230, 10, 30);
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
    $pdf->Cell(0, 10, 'Listado de Consultorios', 0, 1, 'C');
    $pdf->SetFont('Arial', 'I', 12);
    $pdf->Cell(0, 10, 'Reporte generado el: ' . date('d/m/Y'), 0, 1, 'C');

    // Espaciado antes de la tabla
    $pdf->Ln(5);

    // Encabezados de la tabla (Reorganizados para mejor presentación)
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetFillColor(230, 230, 230);

    // Reorganizamos las columnas para hacerlas más legibles
    $pdf->Cell(10, 10, 'Nro', 1, 0, 'C', true);       // Nro
    $pdf->Cell(50, 10, 'Nombre', 1, 0, 'C', true);     // Nombre
    $pdf->Cell(40, 10, 'Capacidad', 1, 0, 'C', true);  // Capacidad
    $pdf->Cell(40, 10, 'Ubicacion', 1, 0, 'C', true);  // Ubicacion
    $pdf->Cell(50, 10, 'Especialidad', 1, 0, 'C', true); // Especialidad
    $pdf->Cell(40, 10, 'Telefono', 1, 0, 'C', true);   // Teléfono
    $pdf->Cell(30, 10, 'Estado', 1, 1, 'C', true);     // Estado
    // Filas de la tabla
    $pdf->SetFont('Arial', '', 10);
    foreach ($consultorios as $index => $consultorio) {
        $pdf->Cell(10, 10, $index + 1, 1, 0, 'C');
        $pdf->Cell(50, 10, $consultorio->nombre, 1, 0, 'L');
        $pdf->Cell(40, 10, $consultorio->capacidad, 1, 0, 'C');
        $pdf->Cell(40, 10, $consultorio->ubicacion, 1, 0, 'L');
        $pdf->Cell(50, 10, $consultorio->especialidad, 1, 0, 'L');
        $pdf->Cell(40, 10, $consultorio->telefono, 1, 0, 'C');
        $pdf->Cell(30, 10, $consultorio->estado, 1, 1, 'L');
    }

    // Pie de página
    $pdf->Ln(10);
    $pdf->SetFont('Arial', 'I', 8);
    $pdf->Cell(0, 10, 'Clinica - Bella Vista.', 0, 0, 'C');

    // Descargar el PDF
    $pdf->Output('D', 'reporte_consultorios.pdf');
}
public function eliminarconsultorio(Request $request){
    $idDoctor = $request->post('id');
    $obj = Consultorio::find($idDoctor);
    if ($obj->delete()) {
      return response()->json(['message' => 'Doctor eliminado con éxito', 'success' => true]);
    } else {
      return response()->json(['message' => 'Error al eliminar el doctor', 'success' => false]);
    }
  }
  public function editarConsultorio(Request $request)
{
    $idConsultorio = $request->post('id');
    $obj = DB::table("consultorios")->where('id', '=', $idConsultorio)->first();

    return view('consultorios.editarconsultorio', compact('obj'));
}

public function editarRegistroConsultorio(Request $request)
{
    // Validar los datos recibidos
    $request->validate([
        'nombre' => 'required|string|max:255',
        'ubicacion' => 'required|string|max:255',
        'capacidad' => 'required|integer|min:1',
        'telefono' => 'nullable|string|max:15',
        'especialidad' => 'required|string|max:255',
        'estado' => 'required|string|in:Disponible,Ocupado,Mantenimiento',
    ]);

    // Obtener el ID del consultorio desde el request
    $idConsultorio = $request->post('idConsultorio');
    $obj = DB::table("consultorios")->where('id', '=', $idConsultorio)->update([
        'nombre' => $request->post('nombre'),
        'ubicacion' => $request->post('ubicacion'),
        'capacidad' => $request->post('capacidad'),
        'telefono' => $request->post('telefono'),
        'especialidad' => $request->post('especialidad'),
        'estado' => $request->post('estado'),
        'updated_at' => now(),
    ]);

    return response()->json(['message' => 'Consultorio actualizado con éxito', 'success' => true]);
}


    
    public function create()
    {
        
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
    public function show(Consultorio $consultorio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Consultorio $consultorio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Consultorio $consultorio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Consultorio $consultorio)
    {
        //
    }
}
