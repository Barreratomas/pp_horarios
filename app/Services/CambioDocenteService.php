<?php

namespace App\Services;

use App\Repositories\CambioDocenteRepository;
use App\Mappers\CambioDocenteMapper;
use App\Models\CambioDocente;
use Exception;

class CambioDocenteService implements CambioDocenteRepository
{
    

    public function obtenerTodosCambiosDocente()
    {
      
        $cambiosDocente = CambioDocente::all();
        return $cambiosDocente;
        
    }

    public function obtenerCambioDocentePorId($id)
    {
        $cambioDocente = CambioDocente::find($id);
        if (is_null($cambioDocente)) {
            return []; 
        }
        return $cambioDocente;
    }
    

    public function guardarCambioDocente($docente_anterior,$docente_nuevo)
    {
        try {
            $cambioDocente = new CambioDocente();
            $cambioDocente->docente_anterior=$docente_anterior;
            $cambioDocente->docente_nuevo=$docente_nuevo;
            $cambioDocente->save();
            return ['succes'=>'Cambio de docente guardado correctamente'];
        } catch (Exception $e) {
            return ['error'=>'se produjo un error al actualizar cambio de docente'];

        }
    }

    public function actualizarCambioDocente($id,$docente_anterior,$docente_nuevo)
    {
        try {
            $cambioDocente = CambioDocente::find($id);
            if (!$cambioDocente) {
                return ['error'=>'hubo un error al buscar el cambio de docente'];
            }
            if (!is_null($docente_anterior)) {
                $cambioDocente->docente_anterior = $docente_anterior;
            }
            if (!is_null($docente_nuevo)) {
                $cambioDocente->docente_nuevo = $docente_nuevo;
            }
            
            $cambioDocente->save();
            return ['succes'=>'Cambio de docente actualizado correctamente'];
        } catch (Exception $e) {
            return ['error'=>'se produjo un error al actualizar cambio de docente'];

        }
    }

    public function eliminarCambioDocentePorId($id)
    {
        try {
            $cambioDocente = CambioDocente::find($id);
            if (!$cambioDocente) {
                return ['error'=>'hubo un error al buscar el cambio de docente'];

            }
            $cambioDocente->delete();
            return ['succes'=>'Cambio de docente eliminado correctamente'];
        } catch (Exception $e) {
            return ['error'=>'se produjo un error al eliminar cambio de docente'];

        }
    }
}
