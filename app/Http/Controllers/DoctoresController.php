<?php

namespace App\Http\Controllers;

use App\Models\config;
use App\Models\doctores;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use FPDF;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class DoctoresController extends Controller
{
    public function index()
    {
        $doctores = doctores::all();
        return view('doctores.Doctores_index',compact('doctores'));
    }
    public function RegistroDoctor()
    {
        return view('doctores.registrodoctores');
    }


    public function RegistroDoctorform(Request $request)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
        'Apellidos' => 'required|string|max:255',
        'Email' => 'required|string|email|max:255|unique:users,email',
        'Contraseña' => 'required|string|min:8|confirmed',
        'telefono' => 'required|string|max:15|regex:/^\+?[0-9\s\-]{7,15}$/',
        'Licencia_medica' => 'required|string|unique:doctores,licencia_medica|max:50',
        'especialidad' => 'required|string|max:255',
    ], [
        // Mensajes de error personalizados
        'nombre.required' => 'El nombre es obligatorio.',
        'Apellidos.required' => 'Los apellidos son obligatorios.',
        'Email.required' => 'El correo electrónico es obligatorio.',
        'Email.unique' => 'El correo electrónico ya está registrado.',
        'Contraseña.required' => 'La contraseña es obligatoria.',
        'Contraseña.min' => 'La contraseña debe tener al menos 8 caracteres.',
        'Contraseña.confirmed' => 'La confirmación de la contraseña no coincide.',
        'telefono.required' => 'El número de teléfono es obligatorio.',
        'telefono.regex' => 'El número de teléfono no tiene un formato válido.',
        'Licencia_medica.required' => 'La licencia médica es obligatoria.',
        'Licencia_medica.unique' => 'La licencia médica ya está registrada.',
        'especialidad.required' => 'La especialidad es obligatoria.',
    ]);

    // Crear el usuario
    $usuario = new User();
    $usuario->name = $request->nombre;
    $usuario->email = $request->Email;
    $usuario->password = Hash::make($request['Contraseña']);
    $usuario->save();

    // Crear el registro del doctor
    $obj = new doctores();
    $obj->user_id = $usuario->id;
    $obj->nombres = mb_strtoupper($request->post('nombre'), 'utf-8');
    $obj->apellidos = mb_strtoupper($request->post('Apellidos'), 'utf-8');
    $obj->telefono = $request->post('telefono');
    $obj->licencia_medica = $request->post('Licencia_medica');
    $obj->especialidad = mb_strtoupper($request->post('especialidad'), 'utf-8');
    $obj->save();
    $usuario->assignRole('doctor');
}



    public function generarReporteDoctores()
{
    $configuracion = config::latest()->first();
    $doctores = doctores::all();

    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 14);

    // Encabezado con el logo y detalles de la clínica
     // Encabezado con el logo en la esquina derecha y detalles de la clínica a la izquierda
     if ($configuracion->logo) {
        $pdf->Image(public_path('storage/' . $configuracion->logo), 170, 10, 30); // Logo en la esquina superior derecha
    }

    $pdf->SetXY(10, 10); // Posicionar el texto del encabezado en la esquina superior izquierda
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 8, $configuracion->nombre, 0, 1, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 6, $configuracion->direccion, 0, 1, 'L');
    $pdf->Cell(0, 6, "Tel: " . $configuracion->telefono . " - Email: " . $configuracion->correo, 0, 1, 'L');

    // Título del reporte
    $pdf->Ln(10);
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(0, 10, 'Listado del Personal Medico', 0, 1, 'C');
    $pdf->SetFont('Arial', 'I', 12);
    $pdf->Cell(0, 10, 'Reporte generado el: ' . date('d/m/Y'), 0, 1, 'C');

    // Espaciado antes de la tabla
    $pdf->Ln(5);

    // Encabezados de la tabla
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetFillColor(230, 230, 230); // Color de fondo para los encabezados
    $pdf->Cell(10, 10, 'Nro', 1, 0, 'C', true);
    $pdf->Cell(60, 10, 'Apellidos y Nombres', 1, 0, 'C', true);
    $pdf->Cell(40, 10, 'Telefono', 1, 0, 'C', true);
    $pdf->Cell(40, 10, 'Licencia Medica', 1, 0, 'C', true);
    $pdf->Cell(40, 10, 'Especialidad', 1, 1, 'C', true);

    // Filas de la tabla
    $pdf->SetFont('Arial', '', 10);
    foreach ($doctores as $index => $doctor) {
        $pdf->Cell(10, 10, $index + 1, 1, 0, 'C');
        $pdf->Cell(60, 10, $doctor->apellidos . ' ' . $doctor->nombres, 1, 0, 'L');
        $pdf->Cell(40, 10, $doctor->telefono, 1, 0, 'C');
        $pdf->Cell(40, 10, $doctor->licencia_medica, 1, 0, 'C');
        $pdf->Cell(40, 10, $doctor->especialidad, 1, 1, 'C');
    }

    // Pie de página
    $pdf->Ln(10);
    $pdf->SetFont('Arial', 'I', 8);
    $pdf->Cell(0, 10, 'Clinica - Bella Vista.', 0, 0, 'C');

    // Descargar el PDF
    $pdf->Output('D', 'reporte_doctores.pdf');
}

public function eliminarDoctor(Request $request){
    $idDoctor = $request->post('id');
    $obj = doctores::find($idDoctor);
    if ($obj->delete()) {
      return response()->json(['message' => 'Doctor eliminado con éxito', 'success' => true]);
    } else {
      return response()->json(['message' => 'Error al eliminar el doctor', 'success' => false]);
    }
  }


  public function editarDoctor(Request $request)
  {
      $idDoctor = $request->post('id');
      $obj = DB::table("doctores")->where('id', '=', $idDoctor)->first();
      $users = DB::table('users')->get();
  
      return view('doctores.editardoctores', compact('obj', 'users'));
  }
  

public function editarRegistroDoctor(Request $request)
{
    // Validar los datos recibidos
    $request->validate([
        'nombres' => 'required|string|max:255',
        'apellidos' => 'required|string|max:255',
        'telefono' => 'required|string|max:15',
        'licencia_medica' => 'required|string|max:50',
        'especialidad' => 'required|string|max:255',
        'user_id' => 'required|exists:users,id',
    ]);

    // Obtener el ID del doctor desde el request
    $idDoctor = $request->post('idDoctor');
    $obj = DB::table("doctores")->where('id', '=', $idDoctor)->update([
        'nombres' => $request->post('nombres'),
        'apellidos' => $request->post('apellidos'),
        'telefono' => $request->post('telefono'),
        'licencia_medica' => $request->post('licencia_medica'),
        'especialidad' => $request->post('especialidad'),
        'user_id' => $request->post('user_id'),
        'updated_at' => now(),
    ]);

    return response()->json(['message' => 'Doctor actualizado con éxito', 'success' => true]);
}


}



