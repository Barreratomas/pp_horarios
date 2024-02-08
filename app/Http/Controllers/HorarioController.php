<?php

namespace App\Http\Controllers;

use App\Http\Requests\HorarioRequest;
use App\Models\Carrera;
use App\Models\Comision;
use App\Models\Horario;
use Illuminate\Http\Request;
use App\Services\HorarioService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;

class HorarioController extends Controller
{
    protected $horarioService;

    public function __construct(HorarioService $horarioService){
        $this->horarioService = $horarioService;
    }

   
   

  
    public function store(Request $request)
    {
        return $this->horarioService->guardarHorario($request);
    }


    public function update(Request $request, $id){
        return $this->horarioService->actualizarHorario($request, $id);
    }

    
    public function destroy($id)
    {
        return $this->horarioService->eliminarHorarioPorId($id);
    }

    public function mostrarFormularioPartial()
    {
        $comisiones = Comision::all();
        $carreras = Carrera::all();
        

        return view('layouts.parcials.formularioHorario', compact('comisiones','carreras'))->render();
    }

    public function mostrarHorario(HorarioRequest $request): View
{        
    $id_comision = $request->input('comision');
    $id_carrera = $request->input('carrera');

    // Obtener los registros que cumplan con el id comision y id carrrera
    // filtra por id comision cuando es igual a la request comision
    $horarios = Horario::where('id_comision', $id_comision)->
    // primero se filtra por carrera (dado que la query se lee de adentro hacia afuera)
    whereHas('comision', function ($query) use ($id_carrera) {
        $query->where('id_carrera', $id_carrera);
    })->get();    
   
    // importo comisiones y carreras
    $formularioHorarioPartial = $this->mostrarFormularioPartial();


    // Retornar la vista con la comisión y los horarios
    return view('horario', compact('horarios', 'id_comision', 'formularioHorarioPartial'));
}

    


    

}
