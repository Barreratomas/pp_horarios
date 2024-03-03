<?php

namespace App\Services;

use App\Repositories\AulaRepository;
use App\Mappers\AulaMapper;
use App\Models\Aula;
use Exception;
use Illuminate\Support\Facades\Log;

class AulaService implements AulaRepository
{
    private $aulaMapper;

    public function __construct(AulaMapper $aulaMapper)
    {
        $this->aulaMapper = $aulaMapper;
    }


    public function obtenerTodasAulas()
    {
        
        $aulas = Aula::all();
        return $aulas;
        
    }

    

    public function obtenerAula($id)
    {
        $aula = Aula::find($id);
        if (is_null($aula)) {
            return [];
        }
            return $aula;
        
    }

    public function guardarAula($nombre,$capacidad,$tipo_aula)
    {
        try {
            $aula = new Aula();
            $aula->nombre=$nombre;
            $aula->tipo_aula=$tipo_aula;
            $aula->capacidad=$capacidad;

            $aula->save();
            return ['success' => 'Aula guardada correctamente'];
        } catch (Exception $e) {
            return ['error' => 'Hubo un error al guardar el aula'];
        }
    }

    public function actualizarAula($nombre,$capacidad,$tipo_aula,$aula)
    {
        if (!$aula) {
            return ['error' => 'hubo un error al buscar el aula '];
        }

    
        try {
            // Actualizar los atributos del aula
            if (!is_null($nombre)) {
                $aula->nombre = $nombre;
            }
            if (!is_null($capacidad)) {
                $aula->capacidad = $capacidad;
            }
            if (!is_null($tipo_aula)) {
                $aula->tipo_aula = $tipo_aula;
            }
            

            $aula->save();
            return ['success' => 'Aula actualizada correctamente'];
        } catch (Exception $e) {
            return ['error' => 'Hubo un error al actualizar el aula'];
        }
    }


    public function eliminarAula($aula)
    {
       
        if (!$aula) {
            return ['error' => 'hubo un error al buscar Aula'];
        }

        
            try{

                // if ($aula->docenteMateria) 
                // {
                //     $docenteMaterias=$aula->docenteMateria;
                //     foreach ($docenteMaterias as $docenteMateria) 
                //     {
                //         // Acceder a la propiedad 'disponibilidad' de cada modelo de DocenteMateria
                //         $disponibilidades=$docenteMateria->disponibilidad;

                //         if ($disponibilidades->isNotEmpty()) 
                //         {
                //             // Iterar sobre las disponibilidades asociadas
                //             foreach ($disponibilidades as $disponibilidad) 
                //             {
                //                 // Acceder a la propiedad 'horario' de cada disponibilidad
                //                 $horario = $disponibilidad->horario;
                //                 if ($horario) 
                //                 {
                //                     // Eliminar  horario asociado
                //                     $horario->delete();
                                    
                //                 }
                //                 // Eliminar la disponibilidad
                //                 $disponibilidad->delete();
                //             }
                //         }
                //         // Eliminar el DocenteMateria
                //         $docenteMateria->delete();
                //     }                
                // }

                $aula->delete();
                return ['success' => 'Aula eliminada correctamente'];
            }catch (Exception $e) {
                return ['error' => 'Hubo un error al eliminar el aula'];

            }
      
        }
        
    //     return ['success' => 'Aula eliminada correctamente'];
    //     return ['error' => 'Hubo un error al eliminar el aula'];
    // }
    

    //----------------------------------------------------------------------------------------------------------
    // Swagger
    public function obtenerAulas(){
        try {
            $aulas = Aula::all();
            return response()->json($aulas, 200);
        } catch (Exception $e) {
            Log::error('Error al obtener las aulas: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al obtener las aulas'], 500);
        }
    }
    public function obtenerAulaPorId($id){
        $aula = Aula::find($id);
        if (!$aula) {
            return response()->json(['error' => 'Aula no encontrada'], 404);
        }
        try {
            return response()->json($aula, 200);
        } catch (Exception $e) {
            Log::error('Error al obtener el aula: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al obtener el aula'], 500);
        }
    }
    public function guardarAulas($aula){
        try {
            $aula = $this->aulaMapper->toAula($aula);
            $aula->save();
            return response()->json($aula, 201);
        } catch (Exception $e) {
            Log::error('Error al guardar el aula: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al guardar el aula'], 500);
        }
    }
    public function actualizarAulas($request, $id){
        $aula = Aula::find($id);
        if (!$aula) {
            return response()->json(['error' => 'Aula no encontrada'], 404);
        }
        try {
            $aula->update($this->aulaMapper->toAulaData($request));
            return response()->json($aula, 200);
        } catch (Exception $e) {
            Log::error('Error al actualizar el aula: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al actualizar el aula'], 500);
        }
    }
    public function eliminarAulas($id){
        try {
            $aula = Aula::find($id);
            if ($aula) {
                $aula->delete();
                return response()->json(['success' => 'Se eliminó el aula'], 200);
            } else {
                return response()->json(['error' => 'No existe el aula'], 404);
            }
        } catch (Exception $e) {
            Log::error('Error al eliminar el aula: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al eliminar el aula'], 500);
        }
    }
}

