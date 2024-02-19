<?php

// Mapper para Usuario
namespace App\Mappers;

use App\Models\Usuario;

class UsuarioMapper
{
    public static function toUsuario($usuarioData)
    {
        return new Usuario([
            'nombre' => $usuarioData->nombre,
            'apellido' => $usuarioData->apellido,
            'email' => $usuarioData->email,
            'id_carrera' => $usuarioData->id_carrera,
            'id_comision' => $usuarioData->id_comision,
        ]);
    }

    public static function toUsuarioData($usuario)
    {
        return [
            'nombre' => $usuario->nombre,
            'apellido' => $usuario->apellido,
            'email' => $usuario->email,
            'id_carrera' => $usuario->id_carrera,
            'id_comision' => $usuario->id_comision,

        ];
    }
}