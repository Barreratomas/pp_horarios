<?php

namespace App\Http\Controllers;

use App\Models\Disponibilidad;
use App\Models\HorarioPrevioDocente;
use App\Models\Materia;
use App\Services\DisponibilidadService;
use DateInterval;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

   


    
    
    public function obtenerRegistrosRecientes()
    {
       // Obtener el registro más reciente para cada id_dm
        $id_dm = Disponibilidad::select('id_dm')
        ->orderBy('created_at', 'desc')
        ->first();

        // Obtener el registro más reciente para cada id_h_p_d
        $id_h_p_d = Disponibilidad::select('id_h_p_d')
        ->orderBy('created_at', 'desc')
        ->first();

        // Obtener el registro más reciente para cada id_aula
        $id_aula = Disponibilidad::select('id_aula')
        ->orderBy('created_at', 'desc')
        ->first();

        // Obtener el registro más reciente para cada id_comision
        $id_comision = Disponibilidad::select('id_comision')
        ->orderBy('created_at', 'desc')
        ->first();

        // Obtener el registro más reciente para cada modulos_semanales
        $modulos_semanales = Materia::select('modulos_semanales')
        ->orderBy('created_at', 'desc')
        ->first();

        // Devolver los resultados
        return [
            'registrosIdDm' => $id_dm,
            'id_h_p_d' => $id_h_p_d,
            'id_aula' => $id_aula,
            'id_comision' => $id_comision,
            'modulos_semanales'=>$modulos_semanales
        ];
    }


    


    public function store(Request $request)
    {   $manual=$request->input('manual');
        if ($manual) {
            $id_h_p_d=$request->input("id_h_p_d");
            $modulos_semanales=$request->input("modulos_semanales");
            $id_dm=$request->input("id_dm");
            $id_comision=$request->input("id_comision");
            $id_aula=$request->input("id_aula");
            $diaInstituto=$request->input("diaInstituto");
            $modulo_inicio=$this->disponibilidadService->horaPrevia($id_h_p_d);
        }else{

            $registrosRecientes = $this->obtenerRegistrosRecientes();
        
            // Obtener los valores más recientes
            $id_h_p_d = $registrosRecientes['id_h_p_d']->id_h_p_d;
            $id_dm = $registrosRecientes['id_dm']->id_dm;
            $id_comision = $registrosRecientes['id_comision']->id_comision;
            $id_aula = $registrosRecientes['id_aula']->id_aula;
            $modulos_semanales = $registrosRecientes['modulos_semanales']->modulos_semanales;
            $diaInstituto = $registrosRecientes['diaInstituto']->diaInstituto;
            $modulo_inicio = null;

        }
        
        
        $distribucion=$this->disponibilidadService->modulosRepartidos($modulos_semanales,$modulo_inicio,$id_dm,$id_comision,$id_aula,$diaInstituto);
        if (!empty($distribucion)) {
            
            foreach ($distribucion as $data) {
                $dia=$data['dia'];
                $modulo_inicio=$data['modulo_inicio'];
                $modulo_fin=$data['modulo_fin'];
                $id_aula=$data['id_aula'];

                $params=[
                    'id_dm'=>$id_dm,
                    'id_h_p_d'=>$request->input("id_h_p_d"),
                    'id_aula'=>$id_aula,
                    'id_comision'=>$request->input("id_comision"),
                    'dia'=>$dia,
                    'modulo_inicio'=>$modulo_inicio,
                    'modulo_fin'=>$modulo_fin,
        
                ];
                
        
        
                $response = $this->disponibilidadService->guardarDisponibilidad($params);
                $responses[] = $response;

               
            }
             // Procesar las respuestas fuera del bucle
            foreach ($responses as $response) {
                if (isset($response['success'])) {
                    // $id_disponibilidad = Disponibilidad::orderBy('created_at', 'desc')->first()->id_disponibilidad;
                    // call_user_func([HorarioController::class, 'store'],['id_disponibilidad' => $id_disponibilidad]);

                    
                    return redirect()->route('disponibilidad.index')->with('success', $response['success']);
                } else {
                    return redirect()->route('disponibilidad.index')->withErrors(['error' => $response['error']]);
                }
            }
            
        }
    
    }

    public function crear(){
        return view("disponibilidad.crearDisponibilidad");
    }
    
    
    public function actualizar(Request $request)
    {   
        $id=$request->input("id");

        $params=[
            'id_dm'=>$request->input("id_dm"),
            'id_dm'=>$request->input("id_h_p_d"),
            'dia'=>$request->input("dia"),
            'modulo_inicio'=>$request->input("modulo_inicio"),
            'modulo_fin'=>$request->input("modulo_fin")

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
