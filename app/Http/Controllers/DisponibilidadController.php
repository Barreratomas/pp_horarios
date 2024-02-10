<?php

namespace App\Http\Controllers;

use App\Services\DisponibilidadService;
use Illuminate\Http\Request;

class DisponibilidadController extends Controller
{
    protected $disponibilidadService;

    public function __construct(DisponibilidadService $disponibilidadService)
    {
        $this->disponibilidadService = $disponibilidadService;
    }

    public function index()
    {
        $disponibilidades = $this->disponibilidadService->obtenerTodasDisponibilidades();
        return view('disponibilidad.index', compact('disponibilidades'));
    }

    public function mostrarDisponibilidad(Request $request)
    {
        $id = $request->input('id');
        $disponibilidad = $this->disponibilidadService->obtenerDisponibilidadPorId($id);
        
        return view('disponibilidad.show', compact('disponibilidad'));
    }

    public function store(Request $request)
    {
        $params=[
            'id_dm'=>$request->input("id_dm"),
            'dia'=>$request->input("dia"),
            'hora_inicio'=>$request->input("hora_inicio"),
            'hora_fin'=>$request->input("hora_fin")

        ];

        $response = $this->disponibilidadService->guardarDisponibilidad($params);
        if (isset($response['success'])) {
            return redirect()->route('disponibilidad.index')->with('success', $response['success']);
        }else{
            return redirect()->route('disponibilidad.index')->withErrors(['error' => $response['error']]);

        }
    }

    
    
    
    public function actualizar(Request $request)
    {   
        $id=$request->input("id");

        $params=[
            'id_dm'=>$request->input("id_dm"),
            'dia'=>$request->input("dia"),
            'hora_inicio'=>$request->input("hora_inicio"),
            'hora_fin'=>$request->input("hora_fin")

        ];
        $response = $this->disponibilidadService->actualizarDisponibilidad($params, $id);
        if (isset($response['success'])) {
            return redirect()->route('disponibilidades.index')->with('success', $response['success']);
        }else{
            return redirect()->route('disponibilidades.index')->withErrors(['error' => $response['error']]);
        }
    
    }

    public function eliminar(Request $request)
    {
        $id = $request->input('id');
        $response = $this->disponibilidadService->eliminarDisponibilidadPorId($id);
        if (isset($response['success'])) {
            return redirect()->route('disponibilidades.index')->with('success', $response['success']);
        }else{
            return redirect()->route('disponibilidades.index')->withErrors(['error' => $response['error']]);

        }
    }
}
