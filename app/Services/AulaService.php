<?php

namespace App\Services;

use App\Repositories\AulaRepository;
use App\Mappers\AulaMapper;
use App\Models\Aula;
use Exception;

class AulaService implements AulaRepository
{

    public function obtenerTodasAulas()
    {
        
        $aulas = Aula::all();
        return $aulas;
        
    }

    

    public function obtenerAula($id)
    {
        $aula = Aula::find($id);
        if (is_null($aula)) {
            return [];
        }
            return $aula;
        
    }

    public function guardarAula($nombre,$tipo_aula,$capacidad)
    {
        try {
            $aula = new Aula();
            $aula->nombre=$nombre;
            $aula->tipo_aula=$tipo_aula;
            $aula->capacidad=$capacidad;

            $aula->save();
            return ['success' => 'Aula guardada correctamente'];
        } catch (Exception $e) {
            return ['error' => 'Hubo un error al guardar el aula'];
        }
    }

    public function actualizarAula($id,$nombre=null,$capacidad=null,$tipo_aula=null,)
    {
        $aula = Aula::find($id);
        if (!$aula) {
            return ['error' => 'hubo un error al buscar Aula'];
        }
    
        try {
            // Actualizar los atributos del aula
            if (!is_null($nombre)) {
                $aula->nombre = $nombre;
            }
            if (!is_null($capacidad)) {
                $aula->capacidad = $capacidad;
            }
            if (!is_null($tipo_aula)) {
                $aula->tipo_aula = $tipo_aula;
            }
            

            $aula->save();
            return ['success' => 'Aula actualizada correctamente'];
        } catch (Exception $e) {
            return ['error' => 'Hubo un error al actualizar el aula'];
        }
    }


    public function eliminarAula($id)
    {
        $aula = Aula::find($id);
        if (!$aula) {
            return ['error' => 'hubo un error al buscar Aula'];
        }

        try {
            $aula->delete();
            return ['success' => 'Aula eliminada correctamente'];
        } catch (Exception $e) {
            return ['error' => 'Hubo un error al eliminar el aula'];
        }
        
    }
}

