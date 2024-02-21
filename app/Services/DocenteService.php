<?php

namespace App\Services;

use App\Repositories\DocenteRepository;
use App\Mappers\DocenteMapper;
use App\Models\Docente;
use Exception;

class DocenteService implements DocenteRepository
{
   

    public function obtenerTodosDocentes()
    {
       
        $docentes = Docente::all();
        return $docentes;
      
    }

    public function obtenerDocentePorDni($dni)
    {
        $docente = Docente::find($dni);

        if (is_null($docente)) {
            return [];
        }
        
        return $docente;
        
    }
    

    public function guardarDocente($dni,$nombre,$apellido,$email)
    {
        try {
            // $docente = $this->usuarioMapper->toDocente($docenteData);
            $docente = new Docente();
        
            // Asignar los valores de los atributos
            $docente->dni = $dni;
            $docente->nombre = $nombre;
            $docente->apellido = $apellido;
            $docente->email = $email;

            // Guardar el docente en la base de datos
            $docente->save();
            return ['success' => 'Docente guardado correctamente'];
        } catch (Exception $e) {
            return ['error' => 'Hubo un error al guardar el docente'];
        }
    }

    public function actualizarDocente($dni,$nombre,$apellido,$email)
    {
        $docente = Docente::find($dni);
        if (!$docente) {
            return ['error' => 'hubo un error al buscar Docente '];
        }

        try {
            if (!is_null($nombre)) {
                $docente->nombre = $nombre;
            }
            if (!is_null($apellido)) {
                $docente->apellido = $apellido;
            }
            if (!is_null($email)) {
                $docente->email = $email;
            }
            
            $docente->save();
            return ['success' => 'Docente actualizado correctamente'];
            
        } catch (Exception $e) {
            return ['error' => 'Hubo un error al actualizar el docente'];
        }
    }

    public function eliminarDocentePorDni($dni)
    {
        $docente = Docente::find($dni);
        if (!$docente) {
            return ['error' => 'hubo un error al buscar Docente'];
        }
        try {
            $docente->delete();
            return ['success' => 'Docente eliminado correctamente'];
        } catch (Exception $e) {
            return ['error' => 'Hubo un error al eliminar el docente'];
        }
    }
}
