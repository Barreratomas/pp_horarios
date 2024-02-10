<?php

namespace App\Services;

use App\Repositories\CarreraRepository;
use App\Mappers\CarreraMapper;
use App\Models\Carrera;
use Exception;

class CarreraService implements CarreraRepository
{
    private $carreraMapper;

    public function __construct(CarreraMapper $carreraMapper) 
    {
        $this->carreraMapper = $carreraMapper;
    }

    public function obtenerTodasCarreras()
    {

        $carreras = Carrera::all();
        return $carreras;
      
    }

    public function obtenerCarreraPorId($id)
    {
        
        $carrera = Carrera::find($id);
        if (is_null($carrera)) {
            return [];
        }
        return $carrera;
        
    }

    public function guardarCarrera($carreraData)
    {
        try {
            $carrera = $this->carreraMapper->toCarrera($carreraData);
            $carrera->save();
            return ['succes'=>'Carrera guardada correctamente'];
        } catch (Exception $e) {
            return ['error'=>'Hubo un error al guardar la carrera'];
        }
    }

    public function actualizarCarrera($id,$nombre)
    {
        try {
            $carrera = Carrera::find($id);
            if (!$carrera) {
                return ['error'=>'hubo un error al buscar carrera'];
            }
            
            $carrera->nombre=$nombre;
            $carrera->save();
            return ['succes'=>'Carrera actualizada correctamente'];
        } catch (Exception $e) {
            return ['error'=>'Hubo un error al actualizar la carrera'];
        }
    }

    public function eliminarCarreraPorId($id)
    {
        try {
            $carrera = Carrera::find($id);
            if (!$carrera) {
                return ['error'=>'hubo un error al buscar  carrera'];

            }
            $carrera->delete();
            return ['succes'=>'Carrera eliminada correctamente'];
        } catch (Exception $e) {
            // Manejar el error aquí
            return ['error'=>'Hubo un error al eliminar la carrera'];
        }
    }
}



