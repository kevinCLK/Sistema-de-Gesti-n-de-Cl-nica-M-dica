<?php

namespace App\Http\Controllers;

use App\Models\doctores;
use App\Models\eventos;
use App\Models\horarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class eventoController extends Controller
{
    //

    public function registrocita(Request $request)
    {
        //$datos = request()->all();
        //return response()->json($datos);

        $doctor = doctores::find($request->doctor_id);
        $fecha_reserva = $request->fecha_reserva;
        $hora_reserva = $request->hora_reserva . ':00';

        $dia = date('l', strtotime($fecha_reserva));
        $dia_de_reserva = $this->traducir_dia($dia);
        //valida si existe el horario del doctor
        $horarios = horarios::where('doctor_id', $doctor->id)
            ->where('dia', $dia_de_reserva)
            ->where('hora_inicio', '<=', $hora_reserva)
            ->where('hora_fin', '>=', $hora_reserva)
            ->exists();
        if (!$horarios) {
            return response()->json(['errors' => ['hora_reserva' => ['El doctor no está disponible en ese horario.']]]);
        }
        //valida si existe eventos duplicados
        $fecha_hora_reserva = $fecha_reserva . " " . $hora_reserva;
        // Valida si existen eventos duplicados
        $eventos_duplicados = eventos::where('doctor_id', $doctor->id)
            ->where('inicio', $fecha_hora_reserva)
            ->exists();
        if ($eventos_duplicados) {
            return response()->json(['errors' => ['hora_reserva' => ['Ya existe una reserva con el mismo doctor en esa fecha y hora.']]]);
        }

        // Ensure consistent format


        $evento = new eventos();
        $evento->titulo = $hora_reserva . " " . $doctor->especialidad;
        $evento->inicio = $fecha_hora_reserva;
        $evento->final = $request->fecha_reserva . " " . $hora_reserva;
        $evento->color = '#e82216';
        $evento->user_id = Auth::user()->id;
        $evento->doctor_id = $request->doctor_id;
        $evento->consultorio_id = '1';
        $evento->save();
        /*return redirect()->route('admin.index')
            ->with('mensaje', 'Se registró la reserva de la cita médica de manera correcta')
            ->with('icono', 'success');*/
    }



    function traducir_dia($dia)
    {
        $dias = [
            'Monday' => 'Lunes',
            'Tuesday' => 'Martes',
            'Wednesday' => 'Miércoles',
            'Thursday' => 'Jueves',
            'Friday' => 'Viernes',
            'Saturday' => 'Sábado',
            'Sunday' => 'Domingo',
        ];

        return $dias[$dia] ?? $dia;
    }
    public function editarEvento($id)
{
    $evento = eventos::find($id);
    if (!$evento) {
        return redirect()->route('eventos.index')->with('error', 'Evento no encontrado');
    }
    return view('evento.editar', compact('evento'));
}


    public function editarRegistroEvento(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'inicio' => 'required|date_format:Y-m-d H:i',
            'final' => 'required|date_format:Y-m-d H:i|after_or_equal:inicio',
            'doctor_id' => 'required|exists:doctores,id',
            'consultorio_id' => 'required|exists:consultorios,id',
        ]);

        $evento = Eventos::find($request->post('idEvento'));
        $doctor = Doctores::find($request->post('doctor_id'));
        $fecha_reserva = $request->post('inicio');
        $hora_reserva = date('H:i', strtotime($fecha_reserva));

        // Valida si existe el horario del doctor
        $dia = date('l', strtotime($fecha_reserva));
        $dia_de_reserva = $this->traducir_dia($dia);
        $horarios = horarios::where('doctor_id', $doctor->id)
            ->where('dia', $dia_de_reserva)
            ->where('hora_inicio', '<=', $hora_reserva)
            ->where('hora_fin', '>=', $hora_reserva)
            ->exists();
        if (!$horarios) {
            return response()->json(['errors' => ['hora_reserva' => ['El doctor no está disponible en ese horario.']]]);
        }
        // valiida si existe un evento duplicado
        $fecha_hora_reserva = $fecha_reserva . " " . $hora_reserva;
        $eventos_duplicados = Eventos::where('doctor_id', $doctor->id)
            ->where('inicio', $fecha_hora_reserva)
            ->exists();
        if ($eventos_duplicados) {
            return response()->json(['errors' => ['hora_reserva' => ['Ya existe una reserva con el mismo doctor en esa fecha y hora.']]]);
        }

        $evento->titulo = $request->post('titulo');
        $evento->inicio = $request->post('inicio');
        $evento->final = $request->post('final');
        $evento->color = $request->post('color') ?? '#e82216'; // Default color
        $evento->doctor_id = $request->post('doctor_id');
        $evento->consultorio_id = $request->post('consultorio_id');
        $evento->save();

        return redirect()->route('eventos.index')
            ->with('mensaje', 'El evento fue actualizado correctamente.')
            ->with('icono', 'success');
    }


}
