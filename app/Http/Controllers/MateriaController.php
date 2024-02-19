<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MateriaService;

class MateriaController extends Controller
{
    protected $materiaService;

    public function __construct(MateriaService $materiaService)
    {
        $this->materiaService = $materiaService;
    }

    public function index()
    {
        $materias = $this->materiaService->obtenerTodasMaterias();
        return view('materia.index', compact('materias'));
    }

    public function mostrarMateria(Request $request)
    {   $id=$request->input("id"); 
        $materia = $this->materiaService->obtenerMateriaPorId($id);
        return view('materia.show', compact('materia'));
    }

    

    

    public function store(Request $request)
    {   
        $nombre=$request->input('nombre');
        $modulos_semanales=$request->input('modulos_semanales');

        $response = $this->materiaService->guardarMateria($nombre,$modulos_semanales);
        if (isset($response['success'])) {
            return redirect()->route('materia.index')->with('success', $response['success']);
        } else {
            return redirect()->route('materia.index')->withErrors(['error' => $response['error']]);
        }
    }

   
    public function update(Request $request)
    {
        $id=$request->input('id');
        $nombre=$request->input('nombre');
        $modulos_semanales=$request->input('modulos_semanales');

        $response = $this->materiaService->actualizarMateria($id,$nombre,$modulos_semanales);
        if (isset($response['success'])) {
            return redirect()->route('materia.index')->with('success', $response['success']);
        } else {
            return redirect()->route('materia.index')->withErrors(['error' => $response['error']]);
        }
    }

    public function eliminar(Request $request)
    {        
        $id=$request->input('id');
 

        $response = $this->materiaService->eliminarMateriaPorId($id);
        if (isset($response['success'])) {
            return redirect()->route('materia.index')->with('success', $response['success']);
        } else {
            return redirect()->route('materia.index')->withErrors(['error' => $response['error']]);
        }
    }
}