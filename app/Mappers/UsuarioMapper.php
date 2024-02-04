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
            'tipo' => $usuarioData->tipo,
            'email' => $usuarioData->email,
            'id_comision' => $usuarioData->id_comision,
        ]);
    }

    public static function toUsuarioData($usuario)
    {
        return [
            'nombre' => $usuario->nombre,
            'apellido' => $usuario->apellido,
            'tipo' => $usuario->tipo,
            'email' => $usuario->email,
            'id_comision' => $usuario->id_comision,
        ];
    }
}