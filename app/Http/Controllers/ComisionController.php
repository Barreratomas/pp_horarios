<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ComisionService;

class ComisionController extends Controller
{
    protected $comisionService;

    public function __construct(ComisionService $comisionService){
        $this->comisionService = $comisionService;
    }

  
    public function index(){
        return $this->comisionService->obtenerTodasComisiones();
    }

   
    public function verComisionesPorCarrera($carrera){
        return $this->comisionService->obtenerTodasComisionesPorCarrera($carrera);
    }

  
    public function show($id)
    {
        return $this->comisionService->obtenerComisionPorId($id);
    }

   
    public function store(Request $request){
        return $this->comisionService->guardarComision($request);
    }


    public function update(Request $request, $id)
    {
        return $this->comisionService->actualizarComision($request, $id);
    }

   
    public function destroy($id){
        return $this->comisionService->eliminarComisionPorId($id);
    }
}

