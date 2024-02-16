<?php

namespace App\Http\Controllers;

use App\Models\Disponibilidad;
use App\Models\HorarioPrevioDocente;
use App\Services\DisponibilidadService;
use DateInterval;
use DateTime;
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

    public function horaPrevia($id_h_p_d)
    {
        $horaPrevia=HorarioPrevioDocente::findOrFail($id_h_p_d)->value("hora");
        $horaLimite = new DateTime('18:50:00');

        $horasPermitidas = [
            '19:20:00' => '1',
            '20:00:00' => '2',
            '20:40:00' => '3',
            '21:20:00' => '4',
            '21:30:00' => '5',
            '22:10:00' => '6',
            '22:50:00' => '7',
        ];
        
        // Verificar si la hora previa tiene el formato correcto (HH:MM:SS)
        if (!preg_match('/^\d{2}:\d{2}:\d{2}$/', $horaPrevia)) {
        // Convertir la hora previa al formato HH:MM:SS
        $horaPrevia = DateTime::createFromFormat('H:i', $horaPrevia)->format('H:i:s');
        }
        
        if ($horaPrevia>$horaLimite) {
            $horarioSiguiente=false;
            foreach ($horasPermitidas as $horaPermtida => $modulo) {
                if ($horarioSiguiente) {
                    return $modulo;
                }

                // se suman 30 min (el tiempo que tiene el docente despues de salir de otro instituto)
                $horaPrevia->add(new DateInterval('PT30M'));
                if ($horaPrevia==$horaPermtida) {
                    return $modulo;
                }elseif($horaPrevia>$horaPermtida) {
                    $horarioSiguiente=true;
                }

            }

           
        }
        
    
    
    }


    

    public function modulosRepartidos($modulos_semanales,$modulo_inicio,$id_dm,$id_comision) 
    {
        $distribucion = [];
        $diasSemana = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'];
        $siguienteDia=false;
        foreach ($diasSemana as $dia) {
            
            switch ($modulos_semanales) {
                case 1:
                case 2:
                case 3:
                    $modulo_fin=($modulo_inicio+$modulos_semanales)-1;
                    $disponible = $this->verificarModulosDia($dia,$modulo_inicio,$modulo_fin,$id_dm,$id_comision);
                    if ($disponible) {
                        $distribucion[] = compact('dia', 'modulo_inicio', 'modulo_fin');
                        
                    }
                    break;
                case 4:
                case 5:
                case 6:
                    if ($siguienteDia && $modulos_semanales==5) {
                        $modulos_semanales=4;
                    }
                    $mitadModulos = ($modulos_semanales % 2 == 0) ? $modulos_semanales / 2 : ceil($modulos_semanales / 2);
                    
                    $modulo_fin = ($modulo_inicio + $mitadModulos) - 1;
                    $disponible = $this->verificarModulosDia($dia, $modulo_inicio, $modulo_fin, $id_dm, $id_comision);
                    if ($disponible) {
                        
                        if ($siguienteDia) {
                            $distribucion[] = compact('dia', 'modulo_inicio', 'modulo_fin');
                        }else{
                            $distribucion[] = compact('dia', 'modulo_inicio', 'modulo_fin');
                            $siguienteDia=true;
                        }
                    }
                    break;
            }
        }
            
         
        
        return $distribucion;
    }
    
    
   
    
    
    private function verificarModulosDia($dia, $modulo_inicio, $modulo_fin, $id_dm,$id_comision) 
    {
        // verifica si ya existe una disponibilidad con el mismo id_dm, id_comision y dia    
        $existenciaDisponibilidad = Disponibilidad::where('id_dm', $id_dm)
        ->where('id_comision', $id_comision)
        ->where('dia', $dia)

        ->where(function ($query) use ($id_dm, $modulo_inicio, $modulo_fin, $dia, $id_comision) {
            //verifica si ya existen modulos que se superpongan que tengan el mismo dia e id comision 
            $query->where(function ($q) use ($modulo_inicio, $modulo_fin, $dia, $id_comision) {
                $q->where('dia', $dia)
                    ->where('id_comision', $id_comision)
                    ->whereBetween('modulo_inicio', [$modulo_inicio, $modulo_fin])
                    ->orWhereBetween('modulo_fin', [$modulo_inicio, $modulo_fin]);

            //verifica si ya existen modulos que se superpongan que tengan el mismo dia e id dm 
            })->orWhere(function ($query2) use ($id_dm, $dia, $modulo_inicio, $modulo_fin) {
                $query2->where('id_dm', $id_dm)
                    ->where('dia', $dia)
                    ->whereBetween('modulo_inicio', [$modulo_inicio, $modulo_fin])
                    ->orWhereBetween('modulo_fin', [$modulo_inicio, $modulo_fin]);
            });
        })->exists();
    
   
        // Si ya existe una disponibilidad para el mismo id_dm y dia, devuelve false
        if (!$existenciaDisponibilidad) {
            return true;
        }
        // Si no existe, devuelve true
        return false;
    }
    
    
    
    

    


    public function store(Request $request)
    { 
        $id_h_p_d=$request->input("id_h_p_d");
        $modulos_semanales=$request->input("modulos_semanales");
        $id_dm=$request->input("id_dm");
        $id_comision=$request->input("id_comision");
        $modulo_inicio=$this->horaPrevia($id_h_p_d);
        
        $distribucion=$this->modulosRepartidos($modulos_semanales,$modulo_inicio,$id_dm,$id_comision);
        if (!empty($distribucion)) {
            
            foreach ($distribucion as $data) {
                $dia=$data['dia'];
                $modulo_inicio=$data['modulo_inicio'];
                $modulo_fin=$data['modulo_fin'];

                $params=[
                    'id_dm'=>$id_dm,
                    'id_h_p_d'=>$request->input("id_h_p_d"),
                    'id_comision'=>$request->input("id_comision"),
                    'dia'=>$dia,
                    'modulo_inicio'=>$modulo_inicio,
                    'hora_fin'=>$modulo_fin,
        
                ];
                
        
        
                $response = $this->disponibilidadService->guardarDisponibilidad($params);
                $responses[] = $response;

               
            }
             // Procesar las respuestas fuera del bucle
            foreach ($responses as $response) {
                if (isset($response['success'])) {
                    return redirect()->route('disponibilidad.index')->with('success', $response['success']);
                } else {
                    return redirect()->route('disponibilidad.index')->withErrors(['error' => $response['error']]);
                }
            }
            
        }
    
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
