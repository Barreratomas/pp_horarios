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
        return $this->materiaService->obtenerTodasMaterias();
    }

  
    public function show($id)
    {
        return $this->materiaService->obtenerMateriaPorId($id);
    }

  
    public function verMateriaPorNombre($nombre)
    {
        return $this->materiaService->obtenerMateriaPorNombre($nombre);
    }

   
     
    public function store(Request $request)
    {
        return $this->materiaService->guardarMateria($request);
    }

  
    public function update(Request $request, $id)
    {
        return $this->materiaService->actualizarMateria($request, $id);
    }

    public function destroy($id)
    {
        return $this->materiaService->eliminarMateriaPorId($id);
    }
}
