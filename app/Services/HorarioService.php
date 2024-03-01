<?php


namespace App\Services;

use App\Mappers\HorarioMapper;

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

    

    public function guardarHorario($params)
    {
        $horario = new Horario();
        foreach ($params as $key => $value) {
            
            $horario->{$key} = $value;
        }
    
        $horario->save();

        if ($horario->id_horario) {
            return ['success' => 'Horario guardado correctamente'];
        } else {
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

     //------------------------------------------------------------------------------------------------------------------
    // Swagger

    public function obtenerTodosHorariosSwagger()
    {
        try{
            $horarios = Horario::all();
            return response()->json($horarios, 200);
        } catch (Exception $e) {
            Log::error('Error al obtener los horarios: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al obtener los horarios'], 500);
        }
    }

    public function obtenerHorarioPorIdSwagger($id){
        try {
            $horario = Horario::find($id);
            if ($horario) {
                return response()->json($horario, 200);
            }
            return response()->json(['error' => 'No existe el horario'], 404);
        } catch (Exception $e) {
            Log::error('Error al obtener el horario: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al obtener el horario'], 500);
        }
    }
    public function guardarHorariosSwagger($horario){
        try {
            $horario = $this->horarioMapper->toHorario($horario);
            $horario->save();
            return response()->json($horario, 201);
        } catch (Exception $e) {
            Log::error('Error al guardar el horario: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al guardar el horario'], 500);
        }
    }
    public function actualizarHorariosSwagger($horario, $id){
        $horario = Horario::find($id);
        if (!$horario) {
            return response()->json(['error' => 'No existe el horario'], 404);
        }
        try {
            $horario->update($this->horarioMapper->toHorarioData($horario));
            return response()->json($horario, 200);
        } catch (Exception $e) {
            Log::error('Error al actualizar el horario: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al actualizar el horario'], 500);
        }
    }
    public function eliminarHorariosSwagger($id){
        try {
            $horario = Horario::find($id);
            if ($horario) {
                $horario->delete();
                return response()->json(['success' => 'Se eliminó el horario'], 200);
            } else {
                return response()->json(['error' => 'No existe el horario'], 404);
            }
        } catch (Exception $e) {
            Log::error('Error al eliminar el horario: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al eliminar el horario'], 500);
        }
    }
}