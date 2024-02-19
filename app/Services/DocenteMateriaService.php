<?php

namespace App\Services;

use App\Repositories\DocenteMateriaRepository;
use App\Mappers\DocenteMateriaMapper;
use App\Models\Disponibilidad;
use App\Models\DocenteMateria;
use Exception;

class DocenteMateriaService implements DocenteMateriaRepository
{
    protected $docenteMateriaMapper;

    public function __construct(DocenteMateriaMapper $docenteMateriaMapper)
    {
        $this->docenteMateriaMapper = $docenteMateriaMapper;
    }

    public function obtenerTodasDocentesMaterias()
    {
        $docentesMaterias = DocenteMateria::all();
        return $docentesMaterias;
    }

    public function obtenerDocenteMateriaPorId($id)
    {
        $docenteMateria = DocenteMateria::find($id);
        if (is_null($docenteMateria)) {
            return [];
        }
        return $docenteMateria;
    }

    
    public function guardarDocenteMateria($docenteMateriaData)
    {
        try {
            $docenteMateria = $this->docenteMateriaMapper->toDocenteMateria($docenteMateriaData);
            $docenteMateria->save();
            return ['success' => 'Docente materia guardado correctamente'];
        } catch (Exception $e) {
            return ['error' => 'Se produjo un error al guardar docente materia'];
        }

    }

    public function actualizarDocenteMateria($id, $dni_docente,$id_materia)
    {
        try {
            $docenteMateria = DocenteMateria::find($id);
            if (!$docenteMateria) {
                return ['error' => 'hubo un error al buscar docente materia'];
            }
            if (!is_null($dni_docente)) {
                $docenteMateria->dni_docente = $dni_docente;
            }
            if (!is_null($id_materia)) {
                $docenteMateria->id_materia = $id_materia;
            }
           
            
            $docenteMateria->save();

            return ['success' => 'Docente materia actualizado correctamente'];
        } catch (Exception $e) {
            return ['error' => 'Se produjo un error al actualizar el docente materia'];
        }
    }

    public function eliminarDocenteMateria($id)
    {
        try {
            $docenteMateria = DocenteMateria::find($id);
            if (!$docenteMateria) {
                return ['error' => 'hubo un error al buscar docente materia'];
            }
            $docenteMateria->delete();
            return ['success' => 'Docente materia eliminado correctamente'];
        } catch (Exception $e) {
            return ['error' => 'Se produjo un error al eliminar el docente materia'];
        }
    }
}
