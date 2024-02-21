<?php

namespace App\Http\Controllers;

use App\Models\HorarioPrevioDocente;
use App\Services\HorarioPrevioDocenteService;

use Illuminate\Http\Request;

class HorarioPrevioDocenteController extends Controller
{
    protected $HorarioPrevioDocenteService;


    public function __construct(HorarioPrevioDocenteService $HorarioPrevioDocenteService)
    {
        $this->HorarioPrevioDocenteService = $HorarioPrevioDocenteService;
    }
    
    public function index()
    {
        $horariosPreviosDocentes = $this->HorarioPrevioDocenteService->obtenerTodosHorariosPreviosDocentes();
        return view('horarios_previos.index', compact('horariosPreviosDocentes'));

    }

    public function mostrarHorarioPrevioDocente(Request $request)
    {
        $id_h_p_d=$request->input("id_h_p_d");
        $horarioPrevioDocente = $this->HorarioPrevioDocenteService->obtenerHorarioPrevioDocentePorId($id_h_p_d);
        return view('horarios_previos.index', compact('horarioPrevioDocente'));
    }


    public function crear(){
        return view('horarioPrevioDocente.crearHorarioPrevioDocente');
    }

   

    public function store(Request $request)
    {
        $dni_docente=$request->input("dni_docente");
        $dia=$request->input("dia");
        $hora=$request->input("hora");
    
        $response = $this->HorarioPrevioDocenteService->guardarHorarioPrevioDocente($dni_docente,$dia,$hora);
        if (isset($response['success'])) {
            return redirect()->route('mostrarFormularioDocenteMateria')->with('success', ['message' => $response['success'], 'dni_docente' => $dni_docente]);
        } else {
            return redirect()->route('storeDocenteMateria')->withErrors(['error' => $response['error'],'dni_docente' => $dni_docente]);
        }

    }

    public function actualizar(Request $request)
    {
        $id_h_p_d=$request->input("id_h_p_d");
        $dni_docente=$request->input("dni_docente");
        $dia=$request->input("dia");
        $hora=$request->input("hora");

        $response = $this->HorarioPrevioDocenteService->actualizarHorarioPrevioDocente($id_h_p_d,$dni_docente,$dia,$hora);
        if (isset($response['success'])) {
            return redirect()->route('horarioPrevioDocente.index')->with('success', ['message' => $response['success']]);
        } else {
            return redirect()->route('horarioPrevioDocente.index')->withErrors(['error' => $response['error']]);
        }

    }

    public function eliminar(Request $request)
    {
        $id_h_p_d=$request->input("id_h_p_d");
        $horarioPrevioDocente = HorarioPrevioDocente::find($id_h_p_d);
        $horarioPrevioDocente->delete();

        $response = $this->HorarioPrevioDocenteService->eliminarHorarioPrevioDocentePorId($id_h_p_d);
        if (isset($response['success'])) {
            return redirect()->route('horarioPrevioDocente.index')->with('success', ['message' => $response['success']]);
        } else {
            return redirect()->route('horarioPrevioDocente.index')->withErrors(['error' => $response['error']]);
        }
        return view('horarios_previos.index');

    }


}
