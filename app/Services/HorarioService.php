<?php


namespace App\Services;

use App\Mappers\HorarioMapper;
use App\Models\Carrera;
use App\Models\Comision;
use App\Models\Horario;
use Exception;
use Illuminate\Support\Facades\Log;

class HorarioService
{
    protected $horarioMapper;

    public function __construct(HorarioMapper $horarioMapper)
    {
        $this->horarioMapper = $horarioMapper;
    }

    

    public function guardarHorario($horarioData)
    {
        try {
            $comision = $this->horarioMapper->toHorario($horarioData);
            $comision->save();
            return ['success' => 'Horario guardado correctamente'];
        } catch (Exception $e) {
            return ['error' => 'Hubo un error al guardar el horario'];
        }
    }

    public function actualizarHorario($id,$params)
    {
        $horario = Horario::find($id);
        if (!$horario) {
            return ['error' => 'Horario no encontrado'];
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
        try {
            $horario = Horario::findOrFail($id);
            $horario->delete();
            return ['success' => 'Horario eliminado exitosamente'];
        } catch (Exception $e) {
            return ['error' => 'Hubo un error al eliminar el horario'];
        }
    }
}