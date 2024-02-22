<?php

namespace App\Http\Controllers;

use App\Http\Requests\HorarioRequest;
use App\Models\Carrera;
use App\Models\Comision;
use App\Models\Disponibilidad;
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

    $horarios = Horario::whereHas('disponibilidad.docenteMateria.comision', function ($query) use ($id_comision, $id_carrera) {
        $query->where('id_comision', $id_comision)
              ->whereHas('carrera', function ($subQuery) use ($id_carrera) {
                  $subQuery->where('id_carrera', $id_carrera);
              });
    })->orderBy('created_at', 'desc')->get();

    // importo comisiones y carreras
    $formularioHorarioPartial = $this->mostrarFormularioPartial();


    // Retornar la vista con la comisión y los horarios
    return view('horario.index', compact('horarios', 'id_comision', 'formularioHorarioPartial'));
    }

    public function crear(){
        return view('horario.crearHorario');
    }

    //    guardar
    public function store(Request $request)
    {   
        $disponibilidad = Disponibilidad::orderBy('created_at', 'desc')->first();
        $id_dm = $disponibilidad->id_dm;

        if (!$id_dm) {
            return redirect()->route('home')->withErrors(['error' => 'No se encontró ningún id_dm disponible']);

        }
            $penultimoRegistros = Disponibilidad::where('id_dm', $id_dm)
                ->orderBy('id_disponibilidad', 'desc')
                ->take(2) // Tomar los dos registros más recientes con el mismo id_dm
                ->get();

            foreach ($penultimoRegistros as $registro) {
                $v_p = (random_int(0, 1) === 0) ? 'v' : 'p';

                $params = [
                    'dia' => $registro->dia,
                    'modulo_inicio' => $registro->modulo_inicio,
                    'modulo_fin' => $registro->modulo_fin,
                    'v_p' => $v_p, // Asignar el valor aleatorio
                    'id_disponibilidad' => $registro->id_disponibilidad,
                    'materia' => $registro->docenteMateria->materia->id_materia,
                    'aula' => $registro->docentemateria->id_aula,
                    'comision' => $registro->docentemateria->id_comision,
                ];
                // dd($params);        

                $response = $this->horarioService->guardarHorario($params);

                if (isset($response['success'])) {
                    // Si se guardó correctamente, redirigir con un mensaje de éxito
                    return redirect()->route('mostrarFormularioHorario')->with('success', ['message' => $response['success']]);
                } else {
                    // Si hubo un error al guardar, redirigir con un mensaje de error
                    return redirect()->route('home')->withErrors(['error' => $response['error']]);
                }
            }
        
    }


    // actualizar
    public function actualizar(HorarioRequest $request)
    {   
        $id=$request->input('id');
        $params = [
            'dia' =>  $request->input('dia'),
            'modulo_inicio' =>  $request->input('modulo_inicio'),
            'modulo_fin' =>  $request->input('modulo_fin'),
            'v_p' =>  $request->input('v_p'),
            'id_disponibilidad' =>  $request->input('id_disponibilidad'),
            'materia' =>  $request->input('materia'),
            'aula' =>  $request->input('aula'),
            'comision' =>  $request->input('comision')
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
