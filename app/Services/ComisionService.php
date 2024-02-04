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
            $comisiones = Comision::all();
            return response()->json($comisiones, 200);
        } catch (Exception $e) {
            Log::error('Error al obtener las comisiones: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al obtener las comisiones'], 500);
        }
    }

    public function obtenerTodasComisionesPorCarrera($carrera)
    {
        try {
            $comisiones = Comision::where('carrera', $carrera)->get();
            return response()->json($comisiones, 200);
        } catch (Exception $e) {
            Log::error('Error al obtener las comisiones: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al obtener las comisiones'], 500);
        }
    }

    public function obtenerComisionPorId($id)
    {
        $comision = Comision::find($id);
        if (!$comision) {
            return response()->json(['error' => 'Comision no encontrada'], 404);
        }
        try {
            return response()->json($comision, 200);
        } catch (Exception $e) {
            Log::error('Error al obtener la comision: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al obtener la comision'], 500);
        }
    }

    public function guardarComision($comisionData)
    {
        try {
            $comision = $this->comisionMapper->toComision($comisionData);
            $comision->save();
            return $comision;
        } catch (Exception $e) {
            Log::error('Error al guardar la comision: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al guardar la comision'], 500);

        }
    }

    public function actualizarComision($request, $id)
    {
        $comision = Comision::find($id);
        if (!$comision) {
            return response()->json(['error' => 'Comision no encontrada'], 404);
        }
        try {
            $comision->fill($request->all());
            $comision->save();
            return response()->json($comision, 200);
        } catch (Exception $e) {
            Log::error('Error al actualizar la comision: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al actualizar la comision'], 500);
        }
    }

    public function eliminarComisionPorId($id)
    {
        $comision = Comision::find($id);
        if (!$comision) {
            return response()->json(['error' => 'Comision no encontrada'], 404);
        }
        try {
            $comision->delete();
            return response()->json(['success' => 'Comision eliminada correctamente'], 200);
        } catch (Exception $e) {
            Log::error('Error al eliminar la comision: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al eliminar la comision'], 500);
        }
    }
}
