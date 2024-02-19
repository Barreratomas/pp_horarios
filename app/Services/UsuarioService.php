<?php

namespace App\Services;

use App\Repositories\UsuarioRepository;
use App\Mappers\UsuarioMapper;
use App\Models\Comision;
use App\Models\Usuario;
use Exception;
use Illuminate\Support\Facades\Log;

class UsuarioService implements UsuarioRepository
{
    protected $usuarioMapper;

    public function __construct(UsuarioMapper $usuarioMapper)
    {
        $this->usuarioMapper = $usuarioMapper;
    }

    public function obtenerTodosUsuarios()
    {
        
        $usuarios = Usuario::all();
        return $usuarios;
       
    }

    public function obtenerUsuarioPorDni($dni)
    {
        $usuario = Usuario::find($dni);
        if (is_null($usuario)) {
            return [];
        }
        return $usuario;
    }

    public function guardarUsuario($usuarioData)
    {
       
        try {

            $idCarrera = $usuarioData['id_carrera'];
            $comision = Comision::where('id_carrera', $idCarrera)
            ->where('capacidad', '>', 0) // Solo comisiones con capacidad disponible
            ->orderBy('capacidad', 'desc') // Ordenar por capacidad descendente para usar primero las más grandes
            ->first();
            if (!$comision) {
                // Si no hay comisiones disponibles con capacidad suficiente, mandar un error
                return ['error' => 'No fue posible encontrar una comision disponible'];
            }
            $usuarioData['id_comision'] = $comision->id_comision;

            $usuario = $this->usuarioMapper->toUsuario($usuarioData);
            $usuario->save();
            
            $comision->capacidad -= 1;
            $comision->save();
            return ['success' => 'Usuario guardado correctamente'];
        } catch (Exception $e) {
            return ['error' => 'Hubo un error al guardar el usuario'];
        }
    }

    public function actualizarUsuario($dni,$params )
    {
        $usuario = Usuario::find($dni);
        if (!$usuario) {
            return ['error' => 'hubo un error al buscar Usuario'];
        }



        try {

            // busca una comisión que coincida con el ID de 
            //comisión y la ID de carrera proporcionados
            $comision = Comision::where('id_comision', $params['id_comision'])
            ->where('id_carrera', $params['id_carrera'])
            ->where('capacidad', '>', 0)
            ->first();
            if (!$comision) {
                return ['error' => 'La comisión seleccionada no es válida para la carrera del usuario o no tiene capacidad disponible'];
            }
            // Encuentra la vieja comisión del usuario
            $viejaComision = Comision::find($usuario->id_comision);
            // Incrementa la capacidad de la vieja comisión en 1
            $viejaComision->capacidad += 1;
            $viejaComision->save();



            // Actualiza los datos del usuario con los nuevos parametros
            foreach ($params as $key => $value) {
                if (!is_null($value)) {
                    $usuario->{$key} = $value;
                }
            }
            
            $usuario->save();
            $comision->capacidad -= 1;
            $comision->save();
            return ['success' => 'Usuario actualizado correctamente'];
            
        } catch (Exception $e) {
            return ['error' => 'Hubo un error al actualizar el usuario'];
        }
    }


    

    public function eliminarUsuarioPorDni($dni)
    {
        $usuario = Usuario::find($dni);
        if (!$usuario) {
            return ['error' => 'hubo un error al buscar Usuario'];
        }
        try {               
            $comision = Comision::find($usuario->id_comision);
            $usuario->delete();
            $comision->capacidad += 1;
            $comision->save();
            return ['success' => 'Usuario eliminado correctamente'];
        } catch (Exception $e) {
            return ['error' => 'Hubo un error al eliminar el usuario'];
        }
    }
}
