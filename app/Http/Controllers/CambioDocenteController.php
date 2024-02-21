<?php

namespace App\Http\Controllers;

use App\Services\CambioDocenteService;
use Illuminate\Http\Request;

class CambioDocenteController extends Controller
{
    protected $cambioDocenteService;

    public function __construct(CambioDocenteService $cambioDocenteService)
    {
        $this->cambioDocenteService = $cambioDocenteService;
    }

    public function index()
    {
        $cambiosDocente = $this->cambioDocenteService->obtenerTodosCambiosDocente();
        return view('cambioDocente.index', compact('cambiosDocente'));
    }

    public function mostrarCambioDocente(Request $request)
    {
        $id = $request->input('id');
        $cambioDocente = $this->cambioDocenteService->obtenerCambioDocentePorId($id);
        
        return view('cambioDocente.show', compact('cambioDocente'));
    }

    public function store(Request $request)
    {
        $docente_anterior=$request->input('docente_anterior');
        $docente_nuevo=$request->input('docente_nuevo');

        $response = $this->cambioDocenteService->guardarCambioDocente($docente_anterior,$docente_nuevo,);
        if (isset($response['success'])) {
            return redirect()->route('cambioDocente.index')->with('success',  $response['success']);
        }else{
            return redirect()->route('cambioDocente.index')->withErrors('error',  $response['error']);

        }
    }

    public function actualizar(Request $request)
    {        
        $id=$request->input('id');
        $docente_anterior=$request->input('docente_anterior');
        $docente_nuevo=$request->input('docente_nuevo');

        $response = $this->cambioDocenteService->actualizarCambioDocente($id,$docente_anterior,$docente_nuevo);
        if (isset($response['success'])) {
            return redirect()->route('cambioDocente.index')->with('success',  $response['success']);
        }else{
            return redirect()->route('cambioDocente.index')->withErrors('error',  $response['error']);

        }
    }

    public function eliminar(Request $request)
    {        
        $id=$request->input('id');
        $response = $this->cambioDocenteService->eliminarCambioDocentePorId($id);
        if (isset($response['success'])) {
            return redirect()->route('cambioDocente.index')->with('success',  $response['success']);
        }else{
            return redirect()->route('cambioDocente.index')->withErrors('error',  $response['error']);

        }
    }
}
