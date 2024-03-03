<?php

namespace App\Services;

use App\Repositories\HorarioPrevioDocenteRepository;
use App\Models\HorarioPrevioDocente;
use Exception;

class HorarioPrevioDocenteService implements HorarioPrevioDocenteRepository
{

    public function obtenerTodosHorariosPreviosDocentes()
    {
       
        $horariosPreviosDocentes = HorarioPrevioDocente::all();
        return $horariosPreviosDocentes;
      
    }

    public function obtenerHorarioPrevioDocentePorId($id_h_p_d)
    {
        $HorarioPrevioDocente = HorarioPrevioDocente::find($id_h_p_d);

        if (is_null($HorarioPrevioDocente)) {
            return [];
        }
        
        return $HorarioPrevioDocente;
        
    }
    

    public function guardarHorarioPrevioDocente($dni_docente,$dia,$hora)
    {
        try {
            $horarioPrevioDocente = new HorarioPrevioDocente();
       
        
            // Verificar si el dni_docente no es null antes de asignarlo
            if ($dni_docente !== null) {
                $horarioPrevioDocente->dni_docente = $dni_docente;
            }

            // Verificar si el día no es null antes de asignarlo
            if ($dia !== null) {
                $horarioPrevioDocente->dia = $dia;
            }

            // Verificar si la hora no es null antes de asignarlo
            if ($hora !== null) {
                $horarioPrevioDocente->hora = $hora;
            }

            $horarioPrevioDocente->save();
            return ['success' => 'Horario Previo del Docente guardado correctamente'];
        } catch (Exception $e) {
            return ['error' => 'Hubo un error al guardar el Horario Previo del Docente'];
        }
    }

    public function actualizarHorarioPrevioDocente($dia,$hora,$h_p_d)
    {
        if (!$h_p_d) {
            return ['error' => 'hubo un error al buscar Docente '];
        }

        try {
            
            if (!is_null($dia)) {
                $h_p_d->apellido = $dia;
            }
            if (!is_null($hora)) {
                $h_p_d->email = $hora;
            }
            
            $h_p_d->save();
            return ['success' => 'Horario Previo del Docente actualizado correctamente'];
            
        } catch (Exception $e) {
            return ['error' => 'Hubo un error al actualizar el Horario Previo del Docente'];
        }
    }

    public function eliminarHorarioPrevioDocentePorId($h_p_d)
    {
       
        if (!$h_p_d) {
            return ['error' => 'hubo un error al buscar Docente'];
        }
        try {
            $h_p_d->delete();
            return ['success' => 'Horario Previo del Docente eliminado correctamente'];
        } catch (Exception $e) {
            return ['error' => 'Hubo un error al eliminar el Horario Previo del Docente'];
        }
    }


}