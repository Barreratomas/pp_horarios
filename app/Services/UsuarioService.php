<?php

namespace App\Services;

use App\Repositories\UsuarioRepository;
use App\Mappers\UsuarioMapper;
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
            $usuario = $this->usuarioMapper->toUsuario($usuarioData);
            $usuario->save();
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
        foreach ($params as $key => $value) {
            if (!is_null($value)) {
                $usuario->{$key} = $value;
            }
        }
        
        $usuario->save();
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
            $usuario->delete();
            return ['success' => 'Usuario eliminado correctamente'];
        } catch (Exception $e) {
            return ['error' => 'Hubo un error al eliminar el usuario'];
        }
    }
}
