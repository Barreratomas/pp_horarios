<?php

namespace App\Http\Controllers;

use App\Services\AulaService;
use Illuminate\Http\Request;

class AulaController extends Controller
{
    protected $aulaService;

    public function __construct(AulaService $aulaService){
        $this->aulaService = $aulaService;
    }

   
    public function index(){
        $aulas = $this->aulaService->obtenerTodasAulas();
        return view('aula.index', compact('aulas'));
    }


   
   
    public function obtenerAula(Request $request){
        $id = $request->input('id');
        $aula = $this->aulaService->obtenerAula($id);
        return view('aula.show', compact('aula'));
    }


  
    public function guardarAula(Request $request){
        $nombre = $request->input('nombre');
        $capacidad = $request->input('capacidad');
        $tipo_aula = $request->input('tipo_aula');

        $response=$this->aulaService->guardarAula($nombre,$capacidad,$tipo_aula);
        if (isset($response['success'])) {
            return redirect()->route('aula.index')->with('success', $response['success']);
        } else {
            return redirect()->route('aula.index')->withErrors(['error' => $response['error']]);
        };
    }


    public function actualizarAula(Request $request){
        $id = $request->input('id');
        $nombre = $request->input('nombre');
        $capacidad = $request->input('capacidad');        
        $tipo_aula = $request->input('tipo_aula');
        $response=$this->aulaService->actualizarAula($id,$nombre,$capacidad,$tipo_aula);
        if (isset($response['success'])) {
            return redirect()->route('aula.index')->with('success', $response['success']);
        } else {
            return redirect()->route('aula.index')->withErrors(['error' => $response['error']]);
        };    }


    public function eliminarAula(Request $request){
        $id = $request->input('id');
        $response=$this->aulaService->eliminarAula($id);
        if (isset($response['success'])) {
            return redirect()->route('aula.index')->with('success', $response['success']);
        } else {
            return redirect()->route('aula.index')->withErrors(['error' => $response['error']]);
        };
    }


}
