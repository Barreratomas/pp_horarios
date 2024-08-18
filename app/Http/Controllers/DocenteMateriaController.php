<?php

namespace App\Http\Controllers;

use App\Http\Requests\DocenteMateriaRequest;
use App\Mappers\DocenteMapper;
use App\Models\Aula;
use App\Models\Carrera;
use App\Models\Comision;
use App\Models\Docente;
use App\Models\DocenteMateria;
use App\Models\HorarioPrevioDocente;
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
    
    public function crear(Docente $docente)
    {
        $materias = Materia::all();
        $aulas = Aula::all(); // Obtener todas las aulas
        $comisiones = Comision::all(); // Obtener todas las comisiones
        $carreras = Carrera::all(); // Obtener todas las car
        
        return view('docenteMateria.crearDocenteMateria', compact('materias', 'aulas', 'comisiones','docente',"carreras"));
    }
    

    
    public function store(DocenteMateriaRequest $request, Docente $docente)
    {
        $dni=$docente->dni;
        $dni_docente = $docente->dni;
        $id_materia = $request->input('id_materia');
        $id_aula = $request->input('id_aula');
        $id_comision = $request->input('id_comision');

        session(['dni_docente' => $dni_docente]);

        $response = $this->docenteMateriaService->guardarDocenteMateria($dni_docente,$id_materia,$id_aula,$id_comision);
        if (isset($response['success'])) {
            return redirect()->route('storeDisponibilidad')->with('success', ['message' => $response['success']]);

        } else {
            return redirect()->route('mostrarFormularioDocenteMateria',['docente'=>$dni])->withErrors(['error' => $response['error']]);
        }
     
    }

    public function formularioActualizar(HorarioPrevioDocente $h_p_d, DocenteMateria $dm  ){
        $materias = Materia::all();
        $aulas = Aula::all(); 
        $comisiones = Comision::all(); 
        $carreras = Carrera::all();
        return view('docenteMateria.actualizarDocenteMateria', compact('h_p_d','dm','materias','aulas','comisiones','carreras'));
    }

    public function actualizar(DocenteMateriaRequest $request, HorarioPrevioDocente $h_p_d , DocenteMateria $dm)
    {   
        $id_materia = $request->input('id_materia');
        $id_aula = $request->input('id_aula');
        $id_comision = $request->input('id_comision');


        $response = $this->docenteMateriaService->actualizarDocenteMateria($dm,$id_materia,$id_aula,$id_comision);
        if (isset($response['success'])) {
            return redirect()->route('actualizarDisponibilidad',['h_p_d'=>$h_p_d->id_h_p_d,'dm'=>$dm->id_dm])->with('success', $response['success']);
        } else {
            return redirect()->route('mostrarActualizarDocenteMateria',['h_p_d'=>$h_p_d->id_h_p_d,'dm'=>$dm->id_dm])->withErrors('error', $response['error']);
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
