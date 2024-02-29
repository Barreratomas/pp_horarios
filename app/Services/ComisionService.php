<?php

namespace App\Services;

use App\Repositories\ComisionRepository;
use App\Mappers\ComisionMapper;
use App\Models\Comision;
use Exception;
use Illuminate\Support\Facades\Log;

class ComisionService implements ComisionRepository
{
    
    protected $comisionMapper;

    public function __construct(ComisionMapper $comisionMapper)
    {
        $this->comisionMapper = $comisionMapper;
    }

    public function obtenerTodasComisiones()
    {
        $comisiones=Comision::all();
        return $comisiones;
        
    }

    

    public function obtenerComisionPorId($id)
    {
        $comision = Comision::find($id);
        if (is_null($comision)) {
            return [];
        }
       
        return $comision;
        
        
    }

    public function guardarComision( $anio,$division,$id_carrera,$capacidad)
    {
        try {
            $comision = new Comision();
            $comision->anio=$anio;
            $comision->division=$division;
            $comision->id_carrera=$id_carrera;
            $comision->capacidad=$capacidad;
            $comision->save();
            return ['success' => 'Comisión guardada correctamente'];
        } catch (Exception $e) {
            Log::error('Error al guardar la comision: ' . $e->getMessage());
            return ['error' => 'Hubo un error al guardar la comisión'];        
        }
    }

    public function actualizarComision($anio, $division,$id_carrera, $capacidad,$comision)
    {
        if (!$comision) {
            return ['error' => 'hubo un error al buscar Comisión'];
        }
        try {
            if (!is_null($anio)) {
                $comision->anio = $anio;
            }
            if (!is_null($division)) {
                $comision->division = $division;
            }
            if (!is_null($id_carrera)) {
                $comision->id_carrera = $id_carrera;
            }
            if (!is_null($capacidad)) {
                $comision->capacidad = $capacidad;
            }

            $comision->save();
            
            
            return ['success' => 'Comisión actualizada correctamente'];
            
        } catch (Exception $e) {
            Log::error('Error al actualizar la comisión: ' . $e->getMessage());
            return ['error' => 'Hubo un error al actualizar la comisión'];
        }
    }

    public function eliminarComisionPorId($comision)
    {
        
        if (!$comision) {
            return ['error' => 'hubo un error al buscar Comisión'];
        }
        try {
            $comision->delete();
            return ['success' => 'Comisión eliminada correctamente'];
        } catch (Exception $e) {
            Log::error('Error al eliminar la comision: ' . $e->getMessage());
            return ['error' => 'Hubo un error al eliminar la comisión'];
        }
    }

    //---------------------------------------------------------------------------------------------------------
    // Swagger

    public function obtenerTodasComisionSwagger(){
        try {
            $comisiones = $this->obtenerTodasComisiones();
            return response()->json($comisiones, 200);
        } catch (Exception $e) {
            Log::error('Error al obtener todas las comisiones: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al obtener todas las comisiones'], 500);
        }
    }
    public function obtenerComisionPorIdSwagger($id){
        try {
            $comision = $this->obtenerComisionPorId($id);
            if (empty($comision)) {
                return response()->json(['error' => 'No existe la comision'], 404);
            }
            return response()->json($comision, 200);
        } catch (Exception $e) {
            Log::error('Error al obtener la comision: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al obtener la comision'], 500);
        }
    }
    public function guardarComisionSwagger($Request){
        try {
            $comision = $this->guardarComision($Request->input('anio'), $Request->input('division'),$Request->input('id_carrera') ,$Request->input('capacidad'));
            return response()->json($comision, 201);
        } catch (Exception $e) {
            Log::error('Error al guardar la comision: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al guardar la comision'], 500);
        }
    }
    public function actualizarComisionSwagger($Request, $id){
        try {
            $comision = $this->actualizarComision($id, $Request->input('anio'), $Request->input('division'),  $Request->input('id_carrera'),$Request->input('capacidad'));
            return response()->json($comision, 200);
        } catch (Exception $e) {
            Log::error('Error al actualizar la comision: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al actualizar la comision'], 500);
        }
    }
    public function eliminarComisionPorIdSwagger($id){
        try {
            $comision = $this->eliminarComisionPorId($id);
            return response()->json($comision, 200);
        } catch (Exception $e) {
            Log::error('Error al eliminar la comision: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al eliminar la comision'], 500);
        }
    }
}
