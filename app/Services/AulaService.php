<?php

namespace App\Services;

use App\Data\AulaData;
use App\Repositories\AulaRepository;
use App\Mappers\AulaMapper;
use App\Models\Aula;
use Exception;
use Illuminate\Support\Facades\Log;

class AulaService implements AulaRepository
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
            return response()->json($aulas, 200);
        } catch (Exception $e) {
            Log::error('Error al obtener las aulas: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al obtener las aulas'], 500);
        }
    }

    public function obtenerTodosLaboratorios()
    {
        try {
            $aulas = Aula::where('laboratorio', true)->get();
            return response()->json($aulas, 200);
        } catch (Exception $e) {
            Log::error('Error al obtener los laboratorios: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al obtener los laboratorios'], 500);
        }
    }

    public function obtenerAulaPorNro($nro)
    {
            $aula = Aula::find($nro);
            if ($aula) {
                return response()->json($aula, 200);
            }
            try {
                return response()->json(['error' => 'No existe el aula'], 404);
            } catch (Exception $e) {
                Log::error('Error al obtener el aula: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al obtener el aula'], 500);
        }
    }

    public function guardarAula($aulaData)
    {
        try {
            $aula = $this->aulaMapper->toAula($aulaData);
            $aula->save();
            return response()->json($aula, 201);
        } catch (Exception $e) {
            Log::error('Error al guardar el aula: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al guardar el aula'], 500);
        }
    }

    public function actualizarAula($request, $nro)
    {
        $aula = Aula::find($nro);
        if (!$aula) {
            return response()->json(['error' => 'No existe el aula'], 404);
        }
        try {
            $aula->update($this->aulaMapper->toAulaData($request));
            return response()->json($aula, 200);
        } catch (Exception $e) {
            Log::error('Error al actualizar el aula: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al actualizar el aula'], 500);
        }
    }

    public function eliminarAulaPorNro($nro)
    {
        try {
            $aula = Aula::find($nro);
            if ($aula) {
                $aula->delete();
                return response()->json(['success' => 'Se eliminó el aula'], 200);
            } else {
                return response()->json(['error' => 'No existe el aula'], 404);
            }
        } catch (Exception $e) {
            Log::error('Error al eliminar el aula: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al eliminar el aula'], 500);
        }
    }
}
