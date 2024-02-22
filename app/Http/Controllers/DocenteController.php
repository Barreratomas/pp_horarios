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
        
        return view('docente.ind', compact('docente'));
    }

    public function crear(){
        return view('docente.crearDocente');
    }

    public function store(Request $request)
    {
        $dni = $request->input('dni');
        $nombre = $request->input('nombre');
        $apellido = $request->input('apellido');
        $email = $request->input('email');
       

        $response = $this->docenteService->guardarDocente($dni,$nombre,$apellido,$email);
        if (isset($response['success'])) {
            session(['dni' => $dni]);

            return redirect()->route('mostrarFormularioHPD')->with('success', ['message' => $response['success'], 'dni' => $dni]);
        } else {
            return redirect()->route('mostrarFormularioDocente')->withErrors(['error' => $response['error']]);
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
            return redirect()->route('docente.i')->with('success', $response['success']);
        } else {
            return redirect()->route('docente.i')->withErrors(['error' => $response['error']]);
        }
    }

    public function eliminar(Request $request)
    {
        $dni=$request->input('dni');
        $response = $this->docenteService->eliminarDocentePorDni($dni);
        if (isset($response['success'])) {
            return redirect()->route('docente.i')->with('success', $response['success']);
        } else {
            return redirect()->route('docente.i')->withErrors(['error' => $response['error']]);
        }
    }
}











