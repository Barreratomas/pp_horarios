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
            // $docente = $this->usuarioMapper->toDocente($docenteData);
            $horarioPrevioDocente = new HorarioPrevioDocente();
       
        
            $horarioPrevioDocente->dni_docente = $dni_docente;
            $horarioPrevioDocente->dia = $dia;
            $horarioPrevioDocente->hora = $hora;    
    
            $horarioPrevioDocente->save();
            return ['success' => 'Horario Previo del Docente guardado correctamente'];
        } catch (Exception $e) {
            return ['error' => 'Hubo un error al guardar el Horario Previo del Docente'];
        }
    }

    public function actualizarHorarioPrevioDocente($id_h_p_d,$dni_docente,$dia,$hora)
    {
        $horarioPrevioDocente = HorarioPrevioDocente::find($id_h_p_d);
        if (!$horarioPrevioDocente) {
            return ['error' => 'hubo un error al buscar Docente '];
        }

        try {
            if (!is_null($dni_docente)) {
                $horarioPrevioDocente->nombre = $dni_docente;
            }
            if (!is_null($dia)) {
                $horarioPrevioDocente->apellido = $dia;
            }
            if (!is_null($hora)) {
                $horarioPrevioDocente->email = $hora;
            }
            
            $horarioPrevioDocente->save();
            return ['success' => 'Horario Previo del Docente actualizado correctamente'];
            
        } catch (Exception $e) {
            return ['error' => 'Hubo un error al actualizar el Horario Previo del Docente'];
        }
    }

    public function eliminarHorarioPrevioDocentePorId($id_h_p_d)
    {
        $horarioPrevioDocente = HorarioPrevioDocente::find($id_h_p_d);
        if (!$horarioPrevioDocente) {
            return ['error' => 'hubo un error al buscar Docente'];
        }
        try {
            $horarioPrevioDocente->delete();
            return ['success' => 'Horario Previo del Docente eliminado correctamente'];
        } catch (Exception $e) {
            return ['error' => 'Hubo un error al eliminar el Horario Previo del Docente'];
        }
    }


}