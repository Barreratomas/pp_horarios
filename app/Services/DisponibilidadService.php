<?php

namespace App\Services;

use App\Mail\AssignedToSchedule;
use App\Repositories\DisponibilidadRepository;
use App\Mappers\DisponibilidadMapper;
use App\Models\Aula;
use App\Models\Comision;
use App\Models\Disponibilidad;
use App\Models\DocenteMateria;
use App\Models\Horario;
use App\Models\HorarioPrevioDocente;
use Carbon\Carbon;
use DateInterval;
use DateTime;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class DisponibilidadService implements DisponibilidadRepository
{
    protected $disponibilidadMapper;

    public function __construct(DisponibilidadMapper $disponibilidadMapper)
    {
        $this->disponibilidadMapper = $disponibilidadMapper;
    }
    public function obtenerTodasDisponibilidades()
    {
        
        $disponibilidades = Disponibilidad::all();
        return $disponibilidades;
        
    }

    public function obtenerDisponibilidadPorId($id)
    {
        
        $disponibilidad=Disponibilidad::find($id);
        if (is_null($disponibilidad)) {
            return [];
        }
        return $disponibilidad;
        
    }

    public function horaPrevia($id_h_p_d)
    {
        
        $modelo=HorarioPrevioDocente::find($id_h_p_d);
        $horaPrevia=$modelo->hora;
        

    


        
       


        

        $horaLimite = new DateTime('18:50');
        $horaLimite = $horaLimite->format('H:i');
        

        $horasPermitidas = [
            '19:20' => 1,
            '20:00' => 2,
            '20:40' => 3,
            '21:20' => 4,
            '21:30' => 5,
            '22:10' => 6,
            '22:50' => 7,
        ];
        
        
        
        if ($horaPrevia> $horaLimite) {
            $horarioSiguiente=false;
            // se suman 30 min (el tiempo que tiene el docente despues de salir de otro instituto)
            $hora_datetime = DateTime::createFromFormat('H:i', $horaPrevia);

            // Sumar 30 minutos
            $hora_datetime->modify('+30 minutes');

            $horaPrevia = $hora_datetime->format('H:i');
            foreach ($horasPermitidas as $horaPermitida => $modulo) {
                
                if ($horarioSiguiente) {
                    $modulo--;

                    return $modulo;
                }

               
                 
                if ($horaPrevia == $horaPermitida) {


                    return $modulo;
                }elseif ($horaPrevia < $horaPermitida) {
                    $horarioSiguiente=true;
                }
               

            }
            dd($horaPrevia);
        }else{
            return null;
        }
        
    
    
    }
    
    public function modulosRepartidos($modulos_semanales,$moduloPrevio,$id_dm,$id_comision,$id_aula,$diaInstituto) 
    {
        
        $modulosPermitidos = range(1, 7);
        $distribucion = [];
        $diasSemana = ['lunes','martes','miercoles','jueves','viernes'];
        $siguienteDia = false;
        foreach ($diasSemana as $dia) {

            if ($dia!==$diaInstituto) {

                foreach ($modulosPermitidos as $modulo) {
                    $modulo_inicio = $modulo; 
                    if ($modulo_inicio >= 7) {
                        continue; // Saltar este módulo y pasar al siguiente
                    }
                    switch ($modulos_semanales) {
                        case 1:
                        case 2:
                        case 3:
                            $modulo_fin = min($modulo_inicio + $modulos_semanales, 7);
                            $disponible = $this->verificarModulosDia($dia, $modulo_inicio, $modulo_fin, $id_dm, $id_comision, $id_aula);
                            if ($disponible) {
                                $distribucion[] = [
                                    'dia' => $dia,
                                    'modulo_inicio' => $modulo_inicio,
                                    'modulo_fin' => $modulo_fin
                                ];                                
                                return $distribucion;

                            }
                            break;
                        case 4:
                        case 5:
                        case 6:
                            if ($siguienteDia && $modulos_semanales == 5) {
                                $modulos_semanales = 4;
                            }
                            $mitadModulos = ($modulos_semanales % 2 == 0) ? $modulos_semanales / 2 : intval(ceil($modulos_semanales / 2));
                            $modulo_fin = min($modulo_inicio + $mitadModulos,7);
                            $disponible = $this->verificarModulosDia($dia, $modulo_inicio, $modulo_fin, $id_dm, $id_comision, $id_aula);
                            if ($disponible) {
                                if ($siguienteDia) {
                                    $distribucion[] = [
                                        'dia' => $dia,
                                        'modulo_inicio' => $modulo_inicio,
                                        'modulo_fin' => $modulo_fin
                                    ];                                    
                                    return $distribucion;

                                } else {
                                    $distribucion[] = [
                                        'dia' => $dia,
                                        'modulo_inicio' => $modulo_inicio,
                                        'modulo_fin' => $modulo_fin
                                    ];                                    
                                    $siguienteDia = true;
                                    break 2;

                                }
                            }
                            break;
                    }
                }
            }else{

                $modulo_inicio=$moduloPrevio;
                
                switch ($modulos_semanales) {
                    case 1:
                    case 2:
                    case 3:
                        $modulo_fin = min($modulo_inicio + $modulos_semanales, 7);
                        $disponible = $this->verificarModulosDia($dia,$modulo_inicio,$modulo_fin,$id_dm,$id_comision,$id_aula);
                        if ($disponible) {
                            $distribucion[] = [
                                'dia' => $dia,
                                'modulo_inicio' => $modulo_inicio,
                                'modulo_fin' => $modulo_fin
                            ];                            
                            return $distribucion;

                        }
                        break;
                    case 4:
                    case 5:
                    case 6:
                        if ($siguienteDia && $modulos_semanales==5) {
                            $modulos_semanales=4;
                        }
                        $mitadModulos = ($modulos_semanales % 2 == 0) ? $modulos_semanales / 2 : intval(ceil($modulos_semanales / 2));
                        
                        $modulo_fin = min($modulo_inicio + $mitadModulos,7);

                        $disponible = $this->verificarModulosDia($dia, $modulo_inicio, $modulo_fin, $id_dm, $id_comision,$id_aula);
                        if ($disponible) {
                            
                            if ($siguienteDia) {
                                $distribucion[] = [
                                    'dia' => $dia,
                                    'modulo_inicio' => $modulo_inicio,
                                    'modulo_fin' => $modulo_fin
                                ];
                                return $distribucion;

                            }else{
                                $distribucion[] = [
                                    'dia' => $dia,
                                    'modulo_inicio' => $modulo_inicio,
                                    'modulo_fin' => $modulo_fin
                                ];
                                $siguienteDia=true;
                                break;
                            }
                        }
                        break;
                }
            }
            
        }
            
        
        return $distribucion=null;;
    }

    private function verificarModulosDia($dia, $modulo_inicio, $modulo_fin, $id_dm,$id_comision,$id_aula) 
    {
        $dm=DocenteMateria::find($id_dm);

        // verificar si ya existe disponibilidad con el mismo dia, comision y en horarios superpuestos
        $existeSuperposicionComision = Disponibilidad::where('dia', $dia)
        ->whereExists(function ($query) use ($id_comision,$modulo_inicio, $modulo_fin) {
            // verificar si ya existe id_dm y id_comision
            $query->selectRaw(1)
                ->from('docentes_materias')
                ->whereColumn('disponibilidades.id_dm', 'docentes_materias.id_dm')
                ->where('docentes_materias.id_comision', $id_comision)
                ->where(function ($query) use ($modulo_inicio, $modulo_fin) {
                    $query->whereBetween('disponibilidades.modulo_inicio', [$modulo_inicio, $modulo_fin])
                  ->orWhereBetween(DB::raw('disponibilidades.modulo_fin -1'), [$modulo_inicio, $modulo_fin]);
                });
        })->exists();
        // verificar si se superponen los horarios

        // verificar si ya existe aula con horarios superpuestos el mismo dia
        $existeSuperposicionAula = Disponibilidad::where('dia', $dia)
        ->whereExists(function ($query) use ($id_aula, $modulo_inicio, $modulo_fin, $dia) {
            $query->selectRaw(1)
                ->from('docentes_materias as dm2')
                ->join('disponibilidades as d2', 'dm2.id_dm', '=', 'd2.id_dm')
                ->where('dm2.id_aula', $id_aula)
                ->where('d2.dia', $dia) // Condición para verificar el mismo día
                ->where(function ($query) use ($modulo_inicio, $modulo_fin) {
                    $query->whereBetween('d2.modulo_inicio', [$modulo_inicio, $modulo_fin])
                    ->orWhereBetween(DB::raw('d2.modulo_fin - 1'), [$modulo_inicio, $modulo_fin]);
                });
        })->exists();

            
        // Verificar si el docente ya tiene disponibilidad en el mismo día y horarios superpuestos
        $existeSuperposicionDocente = Disponibilidad::where('dia', $dia)
        ->whereExists(function ($query) use ($dm, $dia, $modulo_inicio, $modulo_fin) {
            $query->selectRaw(1)
                ->from('docentes_materias as dm2')
                ->join('disponibilidades as d2', 'dm2.id_dm', '=', 'd2.id_dm')
                ->where('dm2.dni_docente', $dm->dni_docente) // Condición para verificar el mismo docente
                ->where('d2.dia', $dia) // Condición para verificar el mismo día
                ->where(function ($query) use ($modulo_inicio, $modulo_fin) {
                    $query->whereBetween('d2.modulo_inicio', [$modulo_inicio, $modulo_fin])
                    ->orWhereBetween(DB::raw('d2.modulo_fin - 1'), [$modulo_inicio, $modulo_fin]);
                });
        })
        ->exists();

        if ($existeSuperposicionComision) {
            session(['error' => 'La comision seleccionada ya no tiene horarios disponibles']);

            return false;


         } elseif ($existeSuperposicionAula) {
            session(['error' => 'El aula seleccionada ya no tiene horarios disponibles']);
            return false;

        } elseif ($existeSuperposicionDocente) {
            session(['error' => 'El docente seleccionado ya no tiene horarios disponibles']);
            return false;

        }
        session()->forget('error'); // Limpiar cualquier mensaje de error existente

        return true;
    }


    public function guardarDisponibilidad($params)
    {
        
        $disponibilidad = new Disponibilidad();
        foreach ($params as $key => $value) {
            $disponibilidad->{$key} = $value;
        }

        if ($disponibilidad->save()) 
        {
            
            Mail::to($disponibilidad->docenteMateria->docente->email)->send(new AssignedToSchedule($disponibilidad->docenteMateria->docente->nombre));

            return ['success' => 'Disponibilidad guardada correctamente'];
        } else {
            return ['error' => 'Hubo un error al guardar la disponibilidad'];
        }
    }

    
    public function actualizarDisponibilidad($params)
    {
        
        $disponibilidad = new Disponibilidad();
        foreach ($params as $key => $value) {
            $disponibilidad->{$key} = $value;
        }
        

        if ($disponibilidad->save()) 
        {
            return ['success' => 'Disponibilidad actualizada correctamente'];
        } else {
            return ['error' => 'Hubo un error al guardar la disponibilidad'];
        }
    }

    public function eliminarDisponibilidadPorId($id)
    {
        try {
            $disponibilidad = Disponibilidad::find($id);
            if (!$disponibilidad) {
                return ['error' => 'hubo un error al buscar disponibilidad'];
                
            }
            $disponibilidad->delete();
            return ['success' => 'Disponibilidad eliminada correctamente'];
        } catch (Exception $e) {
            return ['error' => 'Hubo un error al eliminar la disponibilidad'];
        }
    }

    //------------------------------------------------------------------------------------------------------------------
    // swagger

    public function obtenerTodasDisponibilidadesswagger(){
        try {
            $disponibilidades = Disponibilidad::all();
            return response()->json($disponibilidades, 200);
        } catch (Exception $e) {
            Log::error('Error al obtener las disponibilidades: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al obtener las disponibilidades'], 500);
        }
    }
    public function obtenerDisponibilidadPorIdswagger($id){
        try {
            $disponibilidad = Disponibilidad::find($id);
            if ($disponibilidad) {
                return response()->json($disponibilidad, 200);
            }
            return response()->json(['error' => 'No existe la disponibilidad'], 404);
        } catch (Exception $e) {
            Log::error('Error al obtener la disponibilidad: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al obtener la disponibilidad'], 500);
        }
    }
    public function guardarDisponibilidadswagger($params){
        try {
            $disponibilidad = new Disponibilidad();
            foreach ($params as $key => $value) {
                $disponibilidad->{$key} = $value;
            }
            $disponibilidad->save();
            return response()->json(['success' => 'Disponibilidad guardada correctamente'], 201);
        } catch (Exception $e) {
            Log::error('Error al guardar la disponibilidad: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al guardar la disponibilidad'], 500);
        }
    }
    public function actualizarDisponibilidadswagger($params, $id){
        try {
            $disponibilidad = Disponibilidad::find($id);
            if (!$disponibilidad) {
                return response()->json(['error' => 'No existe la disponibilidad'], 404);
            }
            foreach ($params as $key => $value) {
                if (!is_null($value)) {
                    $disponibilidad->{$key} = $value;
                }
            }
            $disponibilidad->save();
            return response()->json(['success' => 'Disponibilidad actualizada correctamente'], 200);
        } catch (Exception $e) {
            Log::error('Error al actualizar la disponibilidad: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al actualizar la disponibilidad'], 500);
        }
    }
    public function  eliminarDisponibilidadPorIdswagger($id){
        try {
            $disponibilidad = Disponibilidad::find($id);
            if ($disponibilidad) {
                $disponibilidad->delete();
                return response()->json(['success' => 'Se eliminó la disponibilidad'], 200);
            }
            return response()->json(['error' => 'No existe la disponibilidad'], 404);
        } catch (Exception $e) {
            Log::error('Error al eliminar la disponibilidad: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al eliminar la disponibilidad'], 500);
        }
    }
}





