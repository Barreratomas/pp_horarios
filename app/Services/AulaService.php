<?php

namespace App\Services;

use App\Data\AulaData;
use App\Repositories\AulaRepository;
use App\Mappers\AulaMapper;
use App\Models\Aula;
use Exception;
use Illuminate\Support\Facades\Log;

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
        try {
            $aulas = Aula::all();
            return $aulas;
        } catch (Exception $e) {
            Log::error('Error al obtener las aulas: ' . $e->getMessage());
            return [];
        }
    }

    public function obtenerAulasPorTipo($tipo)
    {
        try {
            return Aula::where('tipo', $tipo)->get();
        } catch (Exception $e) {
            Log::error('Error al obtener las aulas por tipo: ' . $e->getMessage());
            return [];
        }
    }

    public function obtenerAula($id)
    {
        try {
            return Aula::find($id);
        } catch (Exception $e) {
            Log::error('Error al obtener el aula: ' . $e->getMessage());
            return null;
        }
    }

    public function guardarAula($aulaData)
    {
        try {
            $aula = $this->aulaMapper->toAula($aulaData);
            $aula->save();
            return $aula;
        } catch (Exception $e) {
            Log::error('Error al guardar el aula: ' . $e->getMessage());
            return null;
        }
    }

    public function actualizarAula($id,$nombre,$tipo_aula,$capacidad)
    {
        $aula = Aula::find($id);
        if (!$aula) {
            Log::error('No existe el aula con el número: ' . $id);
            return false;
        }
    
        try {
            // Actualizar los atributos del aula
            $aula->nombre = $nombre;
            $aula->tipo_aula = $tipo_aula;
            $aula->capacidad = $capacidad;
            $aula->save();
    
            return true;
        } catch (Exception $e) {
            Log::error('Error al actualizar el aula: ' . $e->getMessage());
            return false;
        }
    }



    public function eliminarAula($id)
    {
        try {
            $aula = Aula::find($id);
            if ($aula) {
                $aula->delete();
                return true;
            } else {
                Log::error('No existe el aula con el número: ' . $id);
                return false;
            }
        } catch (Exception $e) {
            Log::error('Error al eliminar el aula: ' . $e->getMessage());
            return false;
        }
    }
}

