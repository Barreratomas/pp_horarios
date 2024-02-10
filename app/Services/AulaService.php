<?php

namespace App\Services;

use App\Repositories\AulaRepository;
use App\Mappers\AulaMapper;
use App\Models\Aula;
use Exception;

class AulaService implements AulaRepository
// catch personalizado
// try {
//     $aula = Aula::find($id);
//     if (!$aula) {
//         throw new AulaNotFoundException("No se encontró el aula con el ID: $id");
//     }
//     return $aula;
// } catch (AulaNotFoundException $e) {
//     Log::error('Error al obtener el aula: ' . $e->getMessage());
//     return null;
// } catch (\Exception $e) {
//     Log::error('Error inesperado al obtener el aula: ' . $e->getMessage());
//     return null;
// }


{
private $aulaMapper;

    public function __construct(AulaMapper $aulaMapper)
    {
        $this->aulaMapper = $aulaMapper;
    }

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

    public function guardarAula($aulaData)
    {
        try {
            $aula = $this->aulaMapper->toAula($aulaData);
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

