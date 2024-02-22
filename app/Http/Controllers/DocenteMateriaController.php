<?php

namespace App\Http\Controllers;

use App\Models\Aula;
use App\Models\Comision;
use App\Models\DocenteMateria;
use App\Models\Materia;
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
    
    public function crear()
    {
        $materias = Materia::all();
        $aulas = Aula::all(); // Obtener todas las aulas
        $comisiones = Comision::all(); // Obtener todas las comisiones
        return view('docenteMateria.crearDocenteMateria', compact('materias', 'aulas', 'comisiones'));
    }
    

    // HAY UN ERROR
    public function store(Request $request)
    {
        $dni_docente = $request->input('dni_docente');
        $id_materia = $request->input('id_materia');
        $id_aula = $request->input('id_aula');
        $id_comision = $request->input('id_comision');

        session(['dni_docente' => $dni_docente]);

        $response = $this->docenteMateriaService->guardarDocenteMateria($dni_docente,$id_materia,$id_aula,$id_comision);
        if (isset($response['success'])) {
            return redirect()->route('storeDisponibilidad')->with('success', ['message' => $response['success'],'dni_docente' => $dni_docente]);

        } else {
            return redirect()->route('mostrarFormularioDocenteMateria')->withErrors(['error' => $response['error'],'dni_docente' => $dni_docente]);
        }
     
    }


    public function actualizar(Request $request)
    {   
        $id = $request->input('id');
        $dni_docente = $request->input('dni_docente');
        $id_materia = $request->input('id_materia');
        $id_aula = $request->input('id_aula');
        $id_comision = $request->input('id_comision');


        $response = $this->docenteMateriaService->actualizarDocenteMateria($id, $dni_docente,$id_materia,$id_aula,$id_comision);
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
