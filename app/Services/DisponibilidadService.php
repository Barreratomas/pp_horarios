<?php

namespace App\Services;

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
use Illuminate\Support\Facades\Log;

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
        $horaPrevia = new DateTime(HorarioPrevioDocente::find($id_h_p_d)->value('hora'));
       
        $horaLimite = new DateTime('18:50');
        $horasPermitidas = [
            '19:20' => 1,
            '20:00' => 2,
            '20:40' => 3,
            '21:20' => 4,
            '21:30' => 5,
            '22:10' => 6,
            '22:50' => 7,
        ];
        
        
        
        if ($horaPrevia->diff($horaLimite)->invert == 1) {
            $horarioSiguiente=false;
            foreach ($horasPermitidas as $horaPermitida => $modulo) {
                if ($horarioSiguiente) {
                    return $modulo;
                }
                // se suman 30 min (el tiempo que tiene el docente despues de salir de otro instituto)
                $horaPrevia->add(new DateInterval('PT30M'));
                if ($horaPrevia->format('H:i') == $horaPermitida) {
                    return $modulo;
                }elseif ($horaPrevia->format('H:i') > $horaPermitida) {
                    $horarioSiguiente=true;
                }
            }
           
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
                    switch ($modulos_semanales) {
                        case 1:
                        case 2:
                        case 3:
                            $modulo_fin = ($modulo_inicio + $modulos_semanales);
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
                            $mitadModulos = ($modulos_semanales % 2 == 0) ? $modulos_semanales / 2 : ceil($modulos_semanales / 2);
                            $modulo_fin = ($modulo_inicio + $mitadModulos);
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
                        $modulo_fin = ($modulo_inicio+$modulos_semanales);
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
                        $mitadModulos = ($modulos_semanales % 2 == 0) ? $modulos_semanales / 2 : ceil($modulos_semanales / 2);
                        
                        $modulo_fin = ($modulo_inicio + $mitadModulos);
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
                                break 2;
                            }
                        }
                        break;
                }
            }
            
        }
            
         
        
        return $distribucion;
    }

    private function verificarModulosDia($dia, $modulo_inicio, $modulo_fin, $id_dm,$id_comision,$id_aula) 
    {
        $dm=DocenteMateria::find($id_dm);

        // verificar si ya existe disponibilidad con el mismo dia, comision y en horarios superpuestos
        $existeSuperposicion = Disponibilidad::where('dia', $dia)
        ->whereExists(function ($query) use ($id_comision) {
            // verifico si ya existe id_dm y id_comision
            $query->selectRaw(1)
                ->from('docentes_materias')
                ->whereColumn('disponibilidades.id_dm', 'docentes_materias.id_dm')
                ->where('docentes_materias.id_comision', $id_comision);
        })
        // verifico si se superponen los horarios
        ->where(function ($query) use ($modulo_inicio, $modulo_fin) {
            $query->whereBetween('disponibilidades.modulo_inicio', [$modulo_inicio, $modulo_fin])
                ->orWhereBetween('disponibilidades.modulo_fin', [$modulo_inicio, $modulo_fin]);
        })
        // verificar si ya existe aula con horarios superpuestos el mismo dia
        ->orWhereExists(function ($query) use ($id_aula, $modulo_inicio, $modulo_fin, $dia) {
            $query->selectRaw(1)
                ->from('docentes_materias as dm2')
                ->join('disponibilidades as d2', 'dm2.id_dm', '=', 'd2.id_dm')
                ->where('dm2.id_aula', $id_aula)
                ->where('d2.dia', $dia) // Condición para verificar el mismo día
                ->where(function ($query) use ($modulo_inicio, $modulo_fin) {
                    $query->whereBetween('d2.modulo_inicio', [$modulo_inicio, $modulo_fin])
                        ->orWhereBetween('d2.modulo_fin', [$modulo_inicio, $modulo_fin]);
                });
        })
            // Verificar si el docente ya tiene disponibilidad en el mismo día y horarios superpuestos
        ->orWhereExists(function ($query) use ($dm, $dia, $modulo_inicio, $modulo_fin) {
            $query->selectRaw(1)
                ->from('docentes_materias as dm2')
                ->join('disponibilidades as d2', 'dm2.id_dm', '=', 'd2.id_dm')
                ->where('dm2.dni_docente', $dm->dni_docente) // Condición para verificar el mismo docente
                ->where('d2.dia', $dia) // Condición para verificar el mismo día
                ->where(function ($query) use ($modulo_inicio, $modulo_fin) {
                    $query->whereBetween('d2.modulo_inicio', [$modulo_inicio, $modulo_fin])
                        ->orWhereBetween('d2.modulo_fin', [$modulo_inicio, $modulo_fin]);
                });
        })
        ->exists();




        // verificar si ya existe disponibilidad con el mismo aula en horarios superpuestos



        // verifica si ya existe una disponibilidad con el mismo id_dm, id_comision y dia  
        // $existenciaDisponibilidad = Disponibilidad::where('id_dm', $id_dm)
        //     ->where('id_comision', function ($subQuery) use ($id_dm) {

        //     $subQuery->select('id_comision')
        //         ->from('docentes_materias')
        //         ->where('id_dm', $id_dm);
        //     })
        //     ->where('dia', $dia)
        //     ->where(function ($query) use ($id_dm, $modulo_inicio, $modulo_fin, $dia, $id_comision,$id_aula) {
        //     //verifica si ya existen modulos que se superpongan que tengan el mismo dia e id comision 
        //     $query->where(function ($q) use ($modulo_inicio, $modulo_fin, $dia, $id_comision) {
        //         $q->where(function ($subQuery) use ($id_comision) {
        //         // busco en docentes materias
        //             $subQuery->select('id_aula')
        //                 ->from('docentes_materias')
        //                 ->where('id_comision', $id_comision);
        //         })
        //             ->where('dia', $dia)
        //             ->whereBetween('modulo_inicio', [$modulo_inicio, $modulo_fin])
        //             ->orWhereBetween('modulo_fin', [$modulo_inicio, $modulo_fin]);

        //     //verifica si ya existen modulos que se superpongan que tengan el mismo dia e id dm 
        //     })->orWhere(function ($query2) use ($id_dm, $dia, $modulo_inicio, $modulo_fin) {

        //         $query2->where('id_dm', $id_dm)
        //             ->where('dia', $dia)
        //             ->whereBetween('modulo_inicio', [$modulo_inicio, $modulo_fin])
        //             ->orWhereBetween('modulo_fin', [$modulo_inicio, $modulo_fin]);

        //     //verifica si ya existen aulas que se superpongan con los modulos en el mismo dia 
        //     })->orWhere(function($query3) use ($id_aula,$modulo_inicio,$modulo_fin,$dia){
        //         // busco en docentes materias
        //         $query3->where(function ($subQuery) use ($id_aula) {
        //             $subQuery->select('id_aula')
        //                 ->from('docentes_materias')
        //                 ->where('id_aula', $id_aula);
        //         })
        //         ->where('dia',$dia)
        //         ->whereBetween('modulo_inicio', [$modulo_inicio, $modulo_fin])
        //         ->orWhereBetween('modulo_fin', [$modulo_inicio, $modulo_fin]);
        //     });
        // })->exists();
    
   
        // Si ya existe una disponibilidad para el mismo id_dm y dia, devuelve false
        // if (!$existenciaDisponibilidad) {
        //     return true;
        // }
        // // Si no existe, devuelve true
        // return false;
    }


    public function guardarDisponibilidad($params)
    {
        
        $disponibilidad = new Disponibilidad();
        foreach ($params as $key => $value) {
            $disponibilidad->{$key} = $value;
        }
        
        $disponibilidad->save();
        if ($disponibilidad->id_disponibilidad) {
            return ['success' => 'Disponibilidad guardada correctamente'];
        } else {
            return ['error' => 'Hubo un error al guardar la disponibilidad'];
        }
    }

    
    public function actualizarDisponibilidad($id,$params)
    {
        try {
            $disponibilidad = Disponibilidad::find($id);
            if (!$disponibilidad) {
                return ['error' => 'hubo un error al buscar disponibilidad'];

            }

            foreach ($params as $key => $value) {
                if (!is_null($value)) {
                    $disponibilidad->{$key} = $value;
                }
            }
            $disponibilidad->save();
            return ['success' => 'Disponibilidad actualizada correctamente'];
        } catch (Exception $e) {
            return ['error' => 'Hubo un error al actualizar la disponibilidad'];

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





