<?php

namespace App\Services;

use App\Repositories\MateriaRepository;
use App\Mappers\MateriaMapper;
use App\Models\Materia;
use Exception;
use Illuminate\Support\Facades\Log;

class MateriaService implements MateriaRepository
{
    
    protected $materiaMapper;

    public function __construct(MateriaMapper $materiaMapper)
    {
        $this->materiaMapper = $materiaMapper;
    }

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


    //-----------------------------------------------------------------------------
    // Swagger

    public function obtenerTodasMateriasSwagger(){
        try {
            $materias = Materia::all();
            return response()->json($materias, 200);
        } catch (Exception $e) {
            Log::error('Error al obtener todas las materias: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al obtener todas las materias'], 500);

        }
    }
    public function obtenerMateriaPorIdSwagger($id){
        $materia = Materia::find($id);
        if ($materia) {
            return response()->json($materia, 200);
        }
        try {
            return response()->json(['error' => 'No existe la materia'], 404);
        } catch (Exception $e) {
            Log::error('Error al obtener la materia: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al obtener la materia'], 500);
        }
    }
    public function guardarMateriaSwagger($nombre,$modulos_semanales){
        try {
            $materia = new Materia();
            $materia->nombre=$nombre;
            $materia->modulos_semanales=$modulos_semanales;
            $materia->save();
            return response()->json($materia, 201);
        } catch (Exception $e) {
            Log::error('Error al guardar la materia: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al guardar la materia'], 500);
        }
    }
    public function actualizarMateriaSwagger($id,$nombre,$modulos_semanales){
        $materia = Materia::find($id);
        if (!$materia) {
            return response()->json(['error' => 'No existe la materia'], 404);
        }
        try {
            if (!is_null($nombre)) {
                $materia->nombre = $nombre;
            }
            if (!is_null($modulos_semanales)) {
                $materia->modulos_semanales = $modulos_semanales;
            }
            $materia->save();
            return response()->json($materia, 200);
        } catch (Exception $e) {
            Log::error('Error al actualizar la materia: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al actualizar la materia'], 500);
        }
    }
    public function eliminarMateriaPorIdSwagger($id){
        $materia = Materia::find($id);
        if (!$materia) {
            return response()->json(['error' => 'No existe la materia'], 404);
        }
        try {
            $materia->delete();
            return response()->json(['success' => 'Materia eliminada correctamente'], 200);
        } catch (Exception $e) {
            Log::error('Error al eliminar la materia: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al eliminar la materia'], 500);
        }
    }
}