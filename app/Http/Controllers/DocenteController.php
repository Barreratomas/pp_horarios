<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DocenteService;

class DocenteController extends Controller
{
    protected $docenteService;

    public function __construct(DocenteService $docenteService)
    {
        $this->docenteService = $docenteService;
    }

    public function index()
    {
        $docentes = $this->docenteService->obtenerTodosDocentes();
        return view('docente.index', compact('docentes'));
    }

    public function mostrarDocente(Request $request)
    {
        $dni = $request->input('dni');
        $docente = $this->docenteService->obtenerDocentePorDni($dni);
        
        return view('docente.show', compact('docente'));
    }

    public function store(Request $request)
    {
        $nombre = $request->input('nombre');
        $apellido = $request->input('apellido');
        $email = $request->input('email');
       

        $response = $this->docenteService->guardarDocente($nombre,$apellido,$email);
        if (isset($response['success'])) {
            return redirect()->route('docentes.index')->with('success', $response['success']);
        } else {
            return redirect()->route('docentes.index')->withErrors(['error' => $response['error']]);
        }
    }

    public function actualizar(Request $request)
    {
        $dni = $request->input('dni');
        $nombre = $request->input('nombre');
        $apellido = $request->input('apellido');
        $email = $request->input('email');

        $response = $this->docenteService->actualizarDocente($dni,$nombre,$apellido,$email);
        if (isset($response['success'])) {
            return redirect()->route('docente.index')->with('success', $response['success']);
        } else {
            return redirect()->route('docente.index')->withErrors(['error' => $response['error']]);
        }
    }

    public function eliminar(Request $request)
    {
        $dni=$request->input('dni');
        $response = $this->docenteService->eliminarDocentePorDni($dni);
        if (isset($response['success'])) {
            return redirect()->route('docente.index')->with('success', $response['success']);
        } else {
            return redirect()->route('docente.index')->withErrors(['error' => $response['error']]);
        }
    }
}











