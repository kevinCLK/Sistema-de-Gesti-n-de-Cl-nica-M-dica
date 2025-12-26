<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    public function index()
    {
        $usuarios = User::all();
        return view('usuarios.usuarios_index', compact('usuarios'));
    }

    public function registro()
    {
        return view('usuarios.registro_usuario');
    }

    public function registroNuevouser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        $user->assignRole('usuario');
        return redirect()->route('user.index')->with('success', 'Usuario registrado con éxito');
        
    }

    public function eliminarUser(Request $request){
        $idDoctor = $request->post('id');
        $obj = User::find($idDoctor);
        if ($obj->delete()) {
          return response()->json(['message' => 'Doctor eliminado con éxito', 'success' => true]);
        } else {
          return response()->json(['message' => 'Error al eliminar el doctor', 'success' => false]);
        }
      }
      public function editaruser(Request $request)
      {
          $idusuario = $request->post('id');
          $obj = User::find($idusuario);
          return view('usuarios.editaruser', compact('obj'));
      }
      public function editarRegistroUser(Request $request)
      {
          // Obtener el ID del usuario desde el request
          $idUsuario = $request->post('idUsuario');
          $obj = User::find($idUsuario);
          $obj->name = $request->post('name');
          $obj->email = $request->post('email');
          $obj->password = bcrypt($request->post('password'));
          $obj->save();
          return redirect()->route('usuarios.index');
      }
}
