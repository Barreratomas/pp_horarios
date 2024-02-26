<?php

namespace App\Services;

use App\Repositories\DocenteRepository;
use App\Mappers\DocenteMapper;
use App\Models\Docente;
use Exception;
use Illuminate\Support\Facades\Log;

class DocenteService implements DocenteRepository
{
   
    protected $docenteMapper;

    public function __construct(DocenteMapper $docenteMapper)
    {
        $this->docenteMapper = $docenteMapper;
    }

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


     //---------------------------------------------------------------------------------------------------------
    // Swagger


    public function obtenerDocente(){
        try {
            $docente = Docente::all();
            return response()->json($docente, 200);
        } catch (Exception $e) {
            Log::error('Error al obtener los docentes: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al obtener los docentes'], 500);
        }
    }
    public function obtenerDocentePorId($id){
        try {
            $docente = Docente::find($id);
            if ($docente) {
                return response()->json($docente, 200);
            }
            return response()->json(['error' => 'No existe el docente'], 404);
        } catch (Exception $e) {
            Log::error('Error al obtener el docente: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al obtener el docente'], 500);
        }
    }
    public function guardarDocentes($docente){
        try {
            $docente = $this->docenteMapper->toDocente($docente);
            $docente->save();
            return response()->json($docente, 201);
        } catch (Exception $e) {
            Log::error('Error al guardar el docente: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al guardar el docente'], 500);
        }
    }
    public function actualizarDocentes($docente, $id){
        $docente = Docente::find($id);
        if (!$docente) {
            return response()->json(['error' => 'No existe el docente'], 404);
        }
        try {
            $docente->update($this->docenteMapper->toDocente($docente));
            return response()->json($docente, 200);
        } catch (Exception $e) {
            Log::error('Error al actualizar el docente: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al actualizar el docente'], 500);
        }
    }
    public function eliminarDocentes($id)
    {
        try {
            $docente = Docente::find($id);
            if ($docente) {
                $docente->delete();
                return response()->json(['success' => 'Se eliminó el docente'], 200);
            } else {
                return response()->json(['error' => 'No existe el docente'], 404);
            }
        } catch (Exception $e) {
            Log::error('Error al eliminar el docente: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al eliminar el docente'], 500);
        }
    }
}
