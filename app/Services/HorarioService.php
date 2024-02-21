<?php


namespace App\Services;

use App\Mappers\HorarioMapper;

use App\Models\Horario;
use Exception;

class HorarioService
{
   

    

    public function guardarHorario($params)
    {
        try {
            $horario = new Horario();
            foreach ($params as $key => $value) {
                
                $horario->{$key} = $value;
            }
            $horario->save();
            return ['success' => 'Horario guardado correctamente'];
        } catch (Exception $e) {
            return ['error' => 'Hubo un error al guardar el horario'];
        }
    }

    public function actualizarHorario($id,$params)
    {
        $horario = Horario::find($id);
        if (!$horario) {
            return ['error' => 'hubo un error al buscar Horario'];
        }
        try {
            foreach ($params as $key => $value) {
                if (!is_null($value)) {
                    $horario->{$key} = $value;
                }
            }
            
            $horario->save();
            return ['success' => 'Horario actualizada correctamente'];
            
        } catch (Exception $e) {
            return ['error' => 'Hubo un error al actualizar el horario'];
        }
    }

    public function eliminarHorarioPorId($id)
    {
        $horario = Horario::find($id);
        if (!$horario) {
            return ['error' => 'hubo un error al buscar Horario'];
        }
        try{
            $horario->delete();
            return ['success' => 'Horario eliminado exitosamente'];
        } catch (Exception $e) {
            return ['error' => 'Hubo un error al eliminar el horario'];
        }
    }
}