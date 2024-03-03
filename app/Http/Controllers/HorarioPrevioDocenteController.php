<?php

namespace App\Http\Controllers;

use App\Http\Requests\HorarioPrevioDocenteRequest;
use App\Models\Docente;
use App\Models\DocenteMateria;
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


    public function crear(Docente $docente){
        return view('horarioPrevioDocente.crearHorarioPrevioDocente', compact('docente'));
    }

   

    public function store(HorarioPrevioDocenteRequest $request, Docente $docente)
    {   
        $dni=$docente->dni;
        $dni_docente=$dni;
        
        $dia = $request->filled("dia") ? $request->input("dia") : null;
        $hora=$request->input("hora");
    
            // Validar si no se envió ninguna hora
        if (empty($hora)) {
            $hora = "17:00"; // Asignar 17:00 si no se envió ninguna hora
        } else {
            // Convertir la cadena de tiempo a un objeto DateTime
            $hora = \DateTime::createFromFormat('H:i', $hora);
            // Obtener solo la hora formateada en "HH:MM"
            $hora = $hora->format('H:i');
        }

        $response = $this->HorarioPrevioDocenteService->guardarHorarioPrevioDocente($dni_docente,$dia,$hora);
        if (isset($response['success'])) {
            return redirect()->route('mostrarFormularioDocenteMateria',['docente'=>$dni])->with('success', ['message' => $response['success']]);
        } else {
            return redirect()->route('mostrarFormularioHPD',['docente'=>$dni])->withErrors(['error' => $response['error']]);
        }

    }

    public function formularioActualizar(HorarioPrevioDocente $h_p_d, DocenteMateria $dm ){
        return view('horarioPrevioDocente.actualizarHorarioPrevioDocente',compact('h_p_d','dm'));
    }

    public function actualizar(HorarioPrevioDocenteRequest $request, HorarioPrevioDocente $h_p_d, DocenteMateria $dm)
    {
        $dia=$request->input("dia");
        $hora=$request->input("hora");

        $response = $this->HorarioPrevioDocenteService->actualizarHorarioPrevioDocente($dia,$hora,$h_p_d);
        
        if (isset($response['success'])) {
            return redirect()->route('mostrarActualizarDocenteMateria',['dm'=>$dm->id_dm])->with('success', ['message' => $response['success']]);
        } else {
            return redirect()->route('mostrarActualizarHPD',['h_p_d'=>$h_p_d->id_h_p_d, 'dm'=>$dm->id_dm])->withErrors(['error' => $response['error']]);
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
