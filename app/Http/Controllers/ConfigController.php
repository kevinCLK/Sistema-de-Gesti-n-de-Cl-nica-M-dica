<?php

namespace App\Http\Controllers;

use App\Models\config;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $configuraciones = config::all();
        return view('configuraciones.configuraciones',compact('configuraciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function configreg()
    {
        return view('configuraciones.registroconfiguracines');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function RegistroConfig(Request $request)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
        'direccion' => 'required|string|max:255',
        'telefono' => 'required|string|max:15',
        'correo' => 'required|email|max:255',
        'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // valida que sea una imagen válida
    ]);

    // Manejo del archivo de imagen
    if ($request->hasFile('logo')) {
        $logoPath = $request->file('logo')->store('logos', 'public'); // Guarda en storage/app/public/logos
    } else {
        return back()->with('error', 'No se pudo subir el logo.');
    }

    // Guarda la configuración en la base de datos
    $configuracion = new config();
    $configuracion->nombre = $request->nombre;
    $configuracion->direccion = $request->direccion;
    $configuracion->telefono = $request->telefono;
    $configuracion->correo = $request->correo;
    $configuracion->logo = $logoPath; // Guarda la ruta del archivo
    $configuracion->save();

    return redirect()->route('config.lista')
        ->with('mensaje', 'Se registró la configuración de la manera correcta')
        ->with('icono', 'success');
}


    /**
     * Display the specified resource.
     */
    public function show(config $config)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(config $config)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, config $config)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(config $config)
    {
        //
    }
}
