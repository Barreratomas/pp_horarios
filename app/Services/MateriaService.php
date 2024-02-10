<?php

namespace App\Services;

use App\Repositories\MateriaRepository;
use App\Mappers\MateriaMapper;
use App\Models\Materia;
use Exception;
use Illuminate\Support\Facades\Log;

class MateriaService implements MateriaRepository
{
    protected $materiaMapper;

    public function __construct(MateriaMapper $materiaMapper)
    {
        $this->materiaMapper = $materiaMapper;
    }

    public function obtenerTodasMaterias()
    {
        
        $materias = Materia::all();
        return $materias;
       
    }

    public function obtenerMateriaPorId($id)
    {
        $materia = Materia::find($id);
        if (is_null($materia)) {
            return [];
        }
        return $materia;
    }

    

    public function guardarMateria($materiaData)
    {
        try {
            $materia = $this->materiaMapper->toMateria($materiaData);
            $materia->save();
            return ['success' => 'Materia guardada correctamente'];
        } catch (Exception $e) {
            return ['error' => 'Hubo un error al guardar la materia'];
        }
    }

    public function actualizarMateria($materiaData, $id)
    {
        $materia = Materia::find($id);
        if (!$materia) {
            return ['error' => 'hubo un error al buscar materia'];
        }
        try {
            $materia->update($this->materiaMapper->toMateriaData($materiaData));
            return ['success' => 'Materia actualizada correctamente'];
        } catch (Exception $e) {
            return ['error' => 'Hubo un error al actualizar la materia'];
        }
    }

    public function eliminarMateriaPorId($id)
    {
        $materia = Materia::find($id);
        if (!$materia) {
            return ['error' => 'hubo un error al buscar materia'];
        }
        try {
            $materia->delete();
            return ['success' => 'Materia eliminada correctamente'];
        } catch (Exception $e) {
            return ['error' => 'Hubo un error al eliminar la materia'];
        }
    }
}