<?php

namespace App\Services;

use App\Repositories\MateriaRepository;
use App\Mappers\MateriaMapper;
use App\Models\Materia;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Validate\MateriaValidate;

class MateriaService implements MateriaRepository
{
    protected $materiaMapper;
    protected $materiaValidate;

    public function __construct(MateriaMapper $materiaMapper, MateriaValidate $materiaValidate)
    {
        $this->materiaMapper = $materiaMapper;
        $this->materiaValidate = $materiaValidate;
    }

    public function obtenerTodasMaterias()
    {
        try {
            $materias = Materia::all();
            return response()->json($materias, 200);
        } catch (Exception $e) {
            Log::error('Error al obtener las materias: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al obtener las materias'], 500);
        }
    }

    public function obtenerMateriaPorId($id)
    {
        $materia = Materia::find($id);
        if ($materia) {
            return response()->json($materia, 200);
        }
        try {
            return response()->json(['error' => 'No existe la materia'], 404);
        } catch (Exception $e) {
            Log::error('Error al obtener la materia: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al obtener la materia'], 500);
        }
    }

    public function obtenerMateriaPorNombre($nombre)
    {
        try {
            $materia = Materia::where('nombre', $nombre)->get();
            return response()->json($materia, 200);
        } catch (Exception $e) {
            Log::error('Error al obtener la materia: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al obtener la materia'], 500);
        }
    }

    public function guardarMateria($materia)
    {
        if($this->materiaValidate->nombreExiste($materia->nombre)){
            return response()->json(['error' => 'Ya existe una materia con ese nombre'], 400);
        }
        try {
            $materia = $this->materiaMapper->toMateria($materia);
            $materia->save();
            return response()->json($materia, 201);
        } catch (Exception $e) {
            Log::error('Error al guardar el horario: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al guardar la materia'], 500);
        }
    }

    public function actualizarMateria($request, $id)
    {
        $materia = Materia::find($id);
        if (!$materia) {
            return response()->json(['error' => 'No existe la materia'], 404);
        } elseif ($this->materiaValidate->nombreExiste($request->nombre)) {
            return response()->json(['error' => 'Ya existe una materia con ese nombre'], 400);
        }
        try {
            $materia->update($this->materiaMapper->toMateriaData($request));
            return response()->json($materia, 200);
        } catch (Exception $e) {
            Log::error('Error al actualizar la materia: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al actualizar la materia'], 500);
        }
    }

    public function eliminarMateriaPorId($id)
    {
        $materia = Materia::find($id);
        if (!$materia) {
            return response()->json(['error' => 'No existe la materia'], 404);
        }
        try {
            $materia->delete();
            return response()->json(['message' => 'MateriaValidate eliminada correctamente'], 200);
        } catch (Exception $e) {
            Log::error('Error al eliminar la materia: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al eliminar la materia'], 500);
        }
    }

}
