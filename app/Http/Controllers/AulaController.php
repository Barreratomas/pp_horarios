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

   
    public function obtenerTodasAulas(){
        $aulas = $this->aulaService->obtenerTodasAulas();
        return view('##', compact('aulas'));
    }


   
    public function obtenerAulasPorTipo(Request $request){
        $tipo = $request->input('tipo');
        $aulas = $this->aulaService->obtenerAulasPorTipo($tipo);
        return view('##', compact('aulas'));
    }



   
    public function obtenerAula(Request $request){
        $id = $request->input('id');
        $aula = $this->aulaService->obtenerAula($id);
        return view('##', compact('aula'));
    }


  
    public function guardarAula(Request $request){
        $nombre = $request->input('nombre');
        $capacidad = $request->input('capacidad');
        $tipo_aula = $request->input('tipo_aula');

        $this->aulaService->guardarAula($nombre,$capacidad,$tipo_aula);
        return redirect()->route('##');
    }


    public function actualizarAula(Request $request){
        $id = $request->input('id');
        $nombre = $request->input('nombre');
        $capacidad = $request->input('capacidad');        
        $tipo_aula = $request->input('tipo_aula');
        $this->aulaService->actualizarAula($id,$nombre,$capacidad,$tipo_aula);
        return redirect()->route('##');
    }


    public function eliminarAula(Request $request){
        $id = $request->input('id');
        $this->aulaService->eliminarAula($id);
        return redirect()->route('aulas.index');
    }


}
