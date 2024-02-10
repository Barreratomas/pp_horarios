<?php

namespace App\Http\Controllers;

use App\Services\CarreraService;


use Illuminate\Http\Request;

class CarreraController extends Controller
{
    protected $carreraService;

    public function __construct(CarreraService $carreraService)
    {
        $this->carreraService = $carreraService;
    }

    public function index()
    {
        $carreras = $this->carreraService->obtenerTodasCarreras();
        return view('carreras.index', compact('carreras'));
    }

    public function mostrarCarrera(Request $request)
    {
        $id = $request->input('id');
        $carrera = $this->carreraService->obtenerCarreraPorId($id);
        
        return view('carreras.show', compact('carrera'));
    }


    public function store(Request $request)
    {
        
        $nombre = $request->input('nombre');

        $response = $this->carreraService->guardarCarrera($nombre);
        if (isset($response['success'])) {
            return redirect()->route('carreras.index')->with('success', $response['success']);
        } else {
            return redirect()->route('carreras.index')->withErrors(['error' => $response['error']]);
        }
    }

    public function actualizar(Request $request)
    {
        $id = $request->input('id');
        $nombre = $request->input('nombre');


        $response = $this->carreraService->actualizarCarrera($id, $nombre);
        if (isset($response['success'])) {
            return redirect()->route('carreras.index')->with('success', $response['success']);
        } else {
            return redirect()->route('carreras.index')->withErrors(['error' => $response['error']]);
        }
    }

    public function eliminar(Request $request)
    {
        $id = $request->input('id');

        $response = $this->carreraService->eliminarCarreraPorId($id);
        if (isset($response['success'])) {
            return redirect()->route('carreras.index')->with('success', $response['success']);
        } else {
            return redirect()->route('carreras.index')->withErrors(['error' => $response['error']]);
        }
    }
}
