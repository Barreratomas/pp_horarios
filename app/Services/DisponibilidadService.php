<?php

namespace App\Services;

use App\Repositories\DisponibilidadRepository;
use App\Mappers\DisponibilidadMapper;
use App\Models\Aula;
use App\Models\Comision;
use App\Models\Disponibilidad;
use App\Models\Horario;
use Carbon\Carbon;
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
