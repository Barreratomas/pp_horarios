<?php

namespace App\Services;

use App\Mappers\HorarioMapper;
use App\Models\Horario;
use App\Repositories\HorarioRepository;
use Exception;
use Illuminate\Support\Facades\Log;

class HorarioService implements HorarioRepository
{
    protected $horarioMapper;

    public function __construct(HorarioMapper $horarioMapper)
    {
        $this->horarioMapper = $horarioMapper;
    }

    public function obtenerTodosHorarios()
    {
        try {
            $horarios = Horario::all();
            return response()->json($horarios, 200);
        } catch (Exception $e) {
            Log::error('Error al obtener los horarios: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al obtener los horarios'], 500);
        }
    }

    public function obtenerHorarioPorId($id)
    {
        $horario = Horario::find($id);
        if ($horario) {
            return response()->json($horario, 200);
        }
        try {
            return response()->json(['error' => 'No existe el horario'], 404);
        } catch (Exception $e) {
            Log::error('Error al obtener el horario: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al obtener el horario'], 500);
        }
    }

    public function guardarHorario($horario)
    {
        try {
            $horario = $this->horarioMapper->toHorario($horario);
            $horario->save();
            return response()->json($horario, 201);
        } catch (Exception $e) {
            Log::error('Error al guardar el horario: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al guardar el horario'], 500);
        }
    }

    public function actualizarHorario($request, $id)
    {
        $horario = Horario::find($id);
        if (!$horario) {
            return response()->json(['error' => 'No existe el aula'], 404);
        }
        try {
            $horario->update($this->horarioMapper->toHorarioData($request));
            return response()->json($horario, 200);
        } catch (Exception $e) {
            Log::error('Error al actualizar el aula: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al actualizar el aula'], 500);
        }
    }

    public function eliminarHorarioPorId($id)
    {
        $horario = Horario::find($id);
        if (!$horario) {
            return response()->json(['error' => 'No existe el horario'], 404);
        }
        try {
            $horario->delete();
            return response()->json(['message' => 'Horario eliminado correctamente'], 200);
        } catch (Exception $e) {
            Log::error('Error al eliminar el horario: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al eliminar el horario'], 500);
        }
    }
}
