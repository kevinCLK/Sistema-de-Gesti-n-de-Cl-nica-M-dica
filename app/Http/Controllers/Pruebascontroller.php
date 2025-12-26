<?php

namespace App\Http\Controllers;

use App\Models\Consultorio;
use App\Models\doctores;
use App\Models\eventos;
use App\Models\horarios;
use App\Models\Paciente;
use Illuminate\Support\Facades\Auth;    
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Pruebascontroller extends Controller
{
    
    public function index(){
        return view('principal');
    }
    public function index_panelP(){
        $pacientesCount = Paciente::count(); // Obtener la cantidad de pacientes
        $doctoresCount = doctores::count(); // Obtener la cantidad de doctores
        $consultoriosCount = Consultorio::count(); // Obtener la cantidad de consultorios
        $horariosCount = horarios::count(); // Obtener la cantidad de horarios
        $usuariosCount = User::count();

        $horario=horarios::all();
        $consultorios=Consultorio::all();
        $doctores=doctores::all();
        $eventos=eventos::all();
        return view('panelP.panelP',compact('pacientesCount', 'doctoresCount', 'consultoriosCount', 
        'horariosCount','usuariosCount','horario','consultorios','doctores','eventos'));
    }

    public function index_C(){
        return view('index');
    }

    public function login(){
        return view('login.login_index');
    }
    public function registro(){
        return view('login.registro_login');
    }

    public function logout(Request $request,Redirector $redirect){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return $redirect->to('/indexC');
    }
    public function formRegistroUsuario(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:4|confirmed',
    ]);

    // Crear un nuevo objeto del modelo User
    $usuario = new User();
    $usuario->name = $request->name; 
    $usuario->email =$request->email;
    $usuario->password = Hash::make($request['password']);
    $usuario->save();
    }
    public function loginAuth(Request $request)
{
    // Validar los datos del formulario
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:4',
    ]);
    // Obtener las credenciales
    $credentials = $request->only('email', 'password');
    // Intentar autenticar al usuario
    if (Auth::attempt($credentials)) {
        // Regenerar la sesión y redirigir al panel
        $request->session()->regenerate();
        return redirect()->intended('/panel'); // Redirige al panel
    }
    // Si la autenticación falla
    return back()->withErrors([
        'email' => 'Las credenciales no son correctas.',
    ])->onlyInput('email');
}
public function cargar_reserva_doctores($id){
    try{
        $eventos = eventos::where('doctor_id', $id)
    ->select(
        'id', 
        'titulo', 
        DB::raw('date_format(inicio, "%Y-%m-%d %H:%i:%s") as inicio'),
        DB::raw('date_format(final, "%Y-%m-%d %H:%i:%s") as final'), 
        'color'
    )
    ->get();
        return response()->json($eventos);
    } catch (\Exception $exception) {
        return response()->json(['mensaje' => 'Error']);
    }
}
public function ver_reservas($id) {
    $eventos = eventos::where('user_id', $id)->get();
    return view('ver_reservas', compact('eventos'));
}
}
