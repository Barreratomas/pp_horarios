<?php

namespace App\Services;

use App\Repositories\DocenteMateriaRepository;
use App\Mappers\DocenteMateriaMapper;
use App\Models\Disponibilidad;
use App\Models\DocenteMateria;
use Exception;

class DocenteMateriaService implements DocenteMateriaRepository
{
    

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

    
    public function guardarDocenteMateria($dni_docente,$id_materia,$id_aula,$id_comision)
    {
        try {
            $docenteMateria=new DocenteMateria();
            $docenteMateria->dni_docente=$dni_docente;
            $docenteMateria->id_materia=$id_materia;
            $docenteMateria->id_aula=$id_aula;
            $docenteMateria->id_comision=$id_comision;

            $docenteMateria->save();
            return ['success' => 'Docente materia guardado correctamente'];
        } catch (Exception $e) {
            return ['error' => 'Se produjo un error al guardar docente materia'];
        }

    }

    public function actualizarDocenteMateria($dm,$id_materia,$id_aula,$id_comision)
    {
        try {
            if (!$dm) {
                return ['error' => 'hubo un error al buscar docente materia'];
            }
          
            if (!is_null($id_materia)) {
                $dm->id_materia = $id_materia;
            }
            if (!is_null($id_aula)) {
                $dm->id_aula = $id_aula;
            }
            if (!is_null($id_comision)) {
                $dm->id_comision = $id_comision;
            }
           
            
            $dm->save();

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
