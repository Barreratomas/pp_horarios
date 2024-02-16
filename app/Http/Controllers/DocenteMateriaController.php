<?php

namespace App\Http\Controllers;

use App\Services\DocenteMateriaService;
use Illuminate\Http\Request;

class DocenteMateriaController extends Controller
{
    protected $docenteMateriaService;

    public function __construct(DocenteMateriaService $docenteMateriaService)
    {
        $this->docenteMateriaService = $docenteMateriaService;
    }

    public function index()
    {
        $docentesMaterias = $this->docenteMateriaService->obtenerTodasDocentesMaterias();
        return view('docenteMateria.index', compact('docentesMaterias'));
    }

    public function mostrarDocenteMateria(Request $request){
        $id=$request->input("id");
        $docenteMateria=$this->docenteMateriaService->obtenerDocenteMateriaPorId($id);
        return view("docenteMateria.show", compact('docenteMateria'));
    }

    public function store(Request $request)
    {
        $dni_docente = $request->input('dni_docente');
        $id_materia = $request->input('id_materia');
        $modulos_semanales = $request->input('modulos_semanales');

        $response = $this->docenteMateriaService->guardarDocenteMateria($dni_docente,$id_materia,$modulos_semanales);
        if (isset($response['success'])) {
            return redirect()->route('docenteMateria.index')->with('success', $response['success']);
        } else {
            return redirect()->route('docenteMateria.index')->withErrors('error', $response['error']);
        }
    }

    public function actualizar(Request $request)
    {   
        $id = $request->input('id');
        $dni_docente = $request->input('dni_docente');
        $id_materia = $request->input('id_materia');
        $modulos_semanales = $request->input('modulos_semanales');

        $response = $this->docenteMateriaService->actualizarDocenteMateria($id, $dni_docente,$id_materia,$modulos_semanales);
        if (isset($response['success'])) {
            return redirect()->route('docenteMateria.index')->with('success', $response['success']);
        } else {
            return redirect()->route('docenteMateria.index')->withErrors('error', $response['error']);
        }
    }

    public function eliminar(Request $request)
    {   
        $id = $request->input('id');
        $response = $this->docenteMateriaService->eliminarDocenteMateria($id);
        if (isset($response['success'])) {
            return redirect()->route('docenteMateria.index')->with('success', $response['success']);
        } else {
            return redirect()->route('docenteMateria.index')->withErrors('error', $response['error']);
        }
    }
}
