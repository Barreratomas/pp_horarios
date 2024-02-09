<?php

namespace App\Services;

use App\Repositories\ComisionRepository;
use App\Mappers\ComisionMapper;
use App\Models\Comision;
use Exception;
use Illuminate\Support\Facades\Log;

class ComisionService implements ComisionRepository
{
    protected $comisionMapper;

    public function __construct(ComisionMapper $comisionMapper)
    {
        $this->comisionMapper = $comisionMapper;
    }

    public function obtenerTodasComisiones()
    {
        try {
            return Comision::all();
        } catch (Exception $e) {
            Log::error('Error al obtener las comisiones: ' . $e->getMessage());
            return [];
        }
    }

    public function obtenerTodasComisionesPorCarrera($carrera)
    {
        try {
            return Comision::where('carrera', $carrera)->get();
        } catch (Exception $e) {
            Log::error('Error al obtener las comisiones: ' . $e->getMessage());
            return [];
        }
    }

    public function obtenerComisionPorId($id)
    {
        $comision = Comision::find($id);
        if (!$comision) {
            return ['error' => 'Comisión no encontrada'];
        }
        try {
            return $comision;
        } catch (Exception $e) {
            Log::error('Error al obtener la comision: ' . $e->getMessage());
            return [];
        }
    }

    public function guardarComision($comisionData)
    {
        try {
            $comision = $this->comisionMapper->toComision($comisionData);
            $comision->save();
            return ['success' => 'Comisión guardada correctamente'];
        } catch (Exception $e) {
            Log::error('Error al guardar la comision: ' . $e->getMessage());
            return ['error' => 'Hubo un error al guardar la comisión'];        
        }
    }

    public function actualizarComision($id, $anio = null, $division = null,$id_carrera = null, $capacidad = null)
    {
        $comision = Comision::find($id);
        if (!$comision) {
            return ['error' => 'Comisión no encontrada'];
        }
        try {
            if (!is_null($anio)) {
                $comision->anio = $anio;
            }
            if (!is_null($division)) {
                $comision->division = $division;
            }
            if (!is_null($id_carrera)) {
                $comision->id_carrera = $id_carrera;
            }
            if (!is_null($capacidad)) {
                $comision->capacidad = $capacidad;
            }

                $comision->save();
                
                
                return ['success' => 'Comisión actualizada correctamente'];
            
        } catch (Exception $e) {
            Log::error('Error al actualizar la comisión: ' . $e->getMessage());
            return ['error' => 'Hubo un error al actualizar la comisión'];
        }
    }

    public function eliminarComisionPorId($id)
    {
        $comision = Comision::find($id);
        try {
            $comision->delete();
            return ['success' => 'Comisión eliminada correctamente'];
        } catch (Exception $e) {
            Log::error('Error al eliminar la comision: ' . $e->getMessage());
            return ['error' => 'Hubo un error al eliminar la comisión'];
        }
    }
}
