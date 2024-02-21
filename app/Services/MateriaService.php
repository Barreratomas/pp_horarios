<?php

namespace App\Services;

use App\Repositories\MateriaRepository;
use App\Mappers\MateriaMapper;
use App\Models\Materia;
use Exception;
use Illuminate\Support\Facades\Log;

class MateriaService implements MateriaRepository
{
    

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

    

    public function guardarMateria($nombre,$modulos_semanales)
    {
        try {
            $materia = new Materia();
            $materia->nombre=$nombre;
            $materia->modulos_semanales=$modulos_semanales;
            $materia->save();
            return ['success' => 'Materia guardada correctamente'];
        } catch (Exception $e) {
            return ['error' => 'Hubo un error al guardar la materia'];
        }
    }

    public function actualizarMateria($id,$nombre,$modulos_semanales)
    {
        $materia = Materia::find($id);
        if (!$materia) {
            return ['error' => 'Hubo un error al buscar materia'];
        }
        try {
            if (!is_null($nombre)) {
                $materia->nombre = $nombre;
            }
            if (!is_null($modulos_semanales)) {
                $materia->modulos_semanales = $modulos_semanales;
            }
            
            
            $materia->save();
            return ['success' => 'Materia actualizada correctamente'];
        } catch (Exception $e) {
            return ['error' => 'Hubo un error al actualizar la materia'];
        }
    }

    public function eliminarMateriaPorId($id)
    {
        $materia = Materia::find($id);
        if (!$materia) {
            return ['error' => 'Hubo un error al buscar materia'];
        }
        try {
            $materia->delete();
            return ['success' => 'Materia eliminada correctamente'];
        } catch (Exception $e) {
            return ['error' => 'Hubo un error al eliminar la materia'];
        }
    }
}