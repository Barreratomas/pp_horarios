<?php

namespace App\Services;

use App\Repositories\CambioDocenteRepository;
use App\Mappers\CambioDocenteMapper;
use App\Models\CambioDocente;
use Exception;
use Illuminate\Support\Facades\Log;

class CambioDocenteService implements CambioDocenteRepository
{
    private $cambioDocenteMapper;

    public function __construct(CambioDocenteMapper $cambioDocenteMapper)
    {
        $this->cambioDocenteMapper = $cambioDocenteMapper;
    }

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

     //---------------------------------------------------------------------------------------------------------
    // Swagger


    public function obtenerTodosCambiosDocenteSwagger(){
        try{
            $cambiosDocente = CambioDocente::all();
            return response()->json($cambiosDocente, 200);
        } catch (Exception $e) {
            Log::error('Error al obtener todos los cambios de docente: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al obtener todos los cambios de docente'], 500);
        }
    }
    public function obtenerCambioDocentePorIdSwagger($id){
        try{
            $cambioDocente = CambioDocente::find($id);
            if ($cambioDocente) {
                return response()->json($cambioDocente, 200);
            }
            return response()->json(['error' => 'No existe el cambio de docente'], 404);
        } catch (Exception $e) {
            Log::error('Error al obtener el cambio de docente: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al obtener el cambio de docente'], 500);
        }
    }
    public function guardarCambioDocenteSwagger($Request){
        try {
            $cambioDocente = $this->cambioDocenteMapper->toCambioDocente($Request);
            $cambioDocente->save();
            return response()->json($cambioDocente, 201);
        } catch (Exception $e) {
            Log::error('Error al guardar el cambio de docente: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al guardar el cambio de docente'], 500);
        }
    }
    public function actualizarCambioDocenteSwagger($Request, $id){
        $cambioDocente = CambioDocente::find($id);
        if (!$cambioDocente) {
            return response()->json(['error' => 'No existe el cambio de docente'], 404);
        }
        try {
            $cambioDocente->update($this->cambioDocenteMapper->toCambioDocenteData($Request));
            return response()->json($cambioDocente, 200);
        } catch (Exception $e) {
            Log::error('Error al actualizar el cambio de docente: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al actualizar el cambio de docente'], 500);
        }
    }
    public function eliminarCambioDocentePorIdSwagger($id){
        try {
            $cambioDocente = CambioDocente::find($id);
            if ($cambioDocente) {
                $cambioDocente->delete();
                return response()->json(['success' => 'Se eliminó el cambio de docente'], 200);
            } else {
                return response()->json(['error' => 'No existe el cambio de docente'], 404);
            }
        } catch (Exception $e) {
            Log::error('Error al eliminar el cambio de docente: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al eliminar el cambio de docente'], 500);
        }
    }
}
