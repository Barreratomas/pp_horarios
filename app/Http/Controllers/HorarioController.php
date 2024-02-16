<?php

namespace App\Http\Controllers;

use App\Http\Requests\HorarioRequest;
use App\Models\Carrera;
use App\Models\Comision;
use App\Models\Horario;
use Illuminate\Http\Request;
use App\Services\HorarioService;
use Illuminate\Contracts\View\View;

class HorarioController extends Controller
{
    protected $horarioService;

    public function __construct(HorarioService $horarioService){
        $this->horarioService = $horarioService;
    }

       // mostrarFormulario
    public function mostrarFormularioPartial()
    {
        $comisiones = Comision::all();
        $carreras = Carrera::all();
        

        return view('layouts.parcials.formularioHorario', compact('comisiones','carreras'))->render();
    }

    // mostrarHorario
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


    //    guardar
    public function store(HorarioRequest $request)
    {   
        $params = [
        'dia' =>  $request->input('dia'),
        'hora_inicio' =>  $request->input('hora_inicio'),
        'hora_fin' =>  $request->input('hora_fin'),
        'v_p' =>  $request->input('v_p'),
        'id_disponibilidad' =>  $request->input('id_disponibilidad'),
        'id_aula' =>  $request->input('id_aula'),
        'id_comision' =>  $request->input('id_comision')
        ];

        $response=$this->horarioService->guardarHorario($params);
        if (isset($response['success'])) {
            // Si se guardo correctamente, redirigir con un mensaje de éxito
            return redirect()->route('horario.index')->with('success', $response['success']);
           
        }else{
    
            // Si hubo un error al guardar, redirigir con un mensaje de error
            return redirect()->route('horario.index')->withErrors(['error' => $response['error']]);
        }
    }


    // actualizar
    public function actualizar(HorarioRequest $request)
    {   
        $id=$request->input('id');
        $params = [
            'dia' =>  $request->input('dia'),
            'hora_incio' =>  $request->input('hora_inicio'),
            'hora_fin' =>  $request->input('hora_fin'),
            'v_p' =>  $request->input('v_p'),
            'id_disponibilidad' =>  $request->input('id_disponibilidad'),
            'id_aula' =>  $request->input('id_aula'),
            'id_comision' =>  $request->input('id_comision')
    ];
        $response=$this->horarioService->actualizarHorario($id,$params);
        if (isset($response['success'])) {
            // Si se actualizo correctamente, redirigir con un mensaje de éxito
            return redirect()->route('horario.index')->with('success', $response['success']);
           
        }else{
    
            // Si hubo un error al actualizar, redirigir con un mensaje de error
            return redirect()->route('horario.index')->withErrors(['error' => $response['error']]);
        }
    }

    // destruir
    public function eliminar(HorarioRequest $request)
    {
        $id=$request->input('id');


        $response=$this->horarioService->eliminarHorarioPorId($id);
        if (isset($response['success'])) {
            // Si se actualizo correctamente, redirigir con un mensaje de éxito
            return redirect()->route('horario.index')->with('success', $response['success']);
           
        }else{
    
            // Si hubo un error al eliminar , redirigir con un mensaje de error
            return redirect()->route('horario.index')->withErrors(['error' => $response['error']]);
        }
    }
    

 

    


    

}
