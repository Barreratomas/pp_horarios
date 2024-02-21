<?php

namespace App\Services;

use App\Repositories\DisponibilidadRepository;
use App\Mappers\DisponibilidadMapper;
use App\Models\Aula;
use App\Models\Comision;
use App\Models\Disponibilidad;
use App\Models\Horario;
use App\Models\HorarioPrevioDocente;
use Carbon\Carbon;
use DateInterval;
use DateTime;
use Exception;


class DisponibilidadService implements DisponibilidadRepository
{
   
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
        $horaPrevia=HorarioPrevioDocente::findOrFail($id_h_p_d)->value("hora");
        $horaLimite = new DateTime('18:50');

        $horasPermitidas = [
            '19:20' => '1',
            '20:00' => '2',
            '20:40' => '3',
            '21:20' => '4',
            '21:30' => '5',
            '22:10' => '6',
            '22:50' => '7',
        ];
        
        
        
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

           
        }else{
            return '1';
        }
        
    
    
    }
    
    public function modulosRepartidos($modulos_semanales,$modulo_inicio,$id_dm,$id_comision,$id_aula,$diaInstituto) 
    {
        $modulosPermitidas = range(1, 7);
        
        $distribucion = [];
        $diasSemana = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'];
        $siguienteDia = false;
        foreach ($diasSemana as $dia) {
            if ($dia!==$diaInstituto) {
                foreach ($modulosPermitidas as $modulo) {
                    switch ($modulos_semanales) {
                        case 1:
                        case 2:
                        case 3:
                            $modulo_fin = ($modulo_inicio + $modulos_semanales) - 1;
                            $disponible = $this->verificarModulosDia($dia, $modulo_inicio, $modulo_fin, $id_dm, $id_comision, $id_aula);
                            if ($disponible) {
                                $distribucion[] = compact('dia', 'modulo_inicio', 'modulo_fin');
                            }
                            break;
                        case 4:
                        case 5:
                        case 6:
                            if ($siguienteDia && $modulos_semanales == 5) {
                                $modulos_semanales = 4;
                            }
                            $mitadModulos = ($modulos_semanales % 2 == 0) ? $modulos_semanales / 2 : ceil($modulos_semanales / 2);
                            $modulo_fin = ($modulo_inicio + $mitadModulos) - 1;
                            $disponible = $this->verificarModulosDia($dia, $modulo_inicio, $modulo_fin, $id_dm, $id_comision, $id_aula);
                            if ($disponible) {
                                if ($siguienteDia) {
                                    $distribucion[] = compact('dia', 'modulo_inicio', 'modulo_fin');
                                } else {
                                    $distribucion[] = compact('dia', 'modulo_inicio', 'modulo_fin');
                                    $siguienteDia = true;
                                }
                            }
                            break;
                    }
                }
            }else{
                switch ($modulos_semanales) {
                    case 1:
                    case 2:
                    case 3:
                        $modulo_fin = ($modulo_inicio+$modulos_semanales)-1;
                        $disponible = $this->verificarModulosDia($dia,$modulo_inicio,$modulo_fin,$id_dm,$id_comision,$id_aula);
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
                        $disponible = $this->verificarModulosDia($dia, $modulo_inicio, $modulo_fin, $id_dm, $id_comision,$id_aula);
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
            
        }
            
         
        
        return $distribucion;
    }

    private function verificarModulosDia($dia, $modulo_inicio, $modulo_fin, $id_dm,$id_comision,$id_aula) 
    {
        // verifica si ya existe una disponibilidad con el mismo id_dm, id_comision y dia    
        $existenciaDisponibilidad = Disponibilidad::where('id_dm', $id_dm)
        ->where('id_comision', $id_comision)
        ->where('dia', $dia)

        ->where(function ($query) use ($id_dm, $modulo_inicio, $modulo_fin, $dia, $id_comision,$id_aula) {
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

            //verifica si ya existen aulas que se superpongan con los modulos en el mismo dia 
            })->orWhere(function($query3) use ($id_aula,$modulo_inicio,$modulo_fin,$dia){
                $query3->where('id_aula',$id_aula)
                ->where('dia',$dia)
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


    public function guardarDisponibilidad($params)
    {
        try {
            $disponibilidad = new Disponibilidad();
            foreach ($params as $key => $value) {
                $disponibilidad->{$key} = $value;
            }
            
            $disponibilidad->save();
            return ['success' => 'Disponibilidad guardada correctamente'];
        } catch (Exception $e) {
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
}





