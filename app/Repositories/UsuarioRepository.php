<?php

namespace App\Repositories;


interface UsuarioRepository
{
    public function obtenerTodosUsuarios();
    public function obtenerUsuarioPorDni($dni);
    public function guardarUsuario($params);
    public function actualizarUsuario($params,$usuario,);
    public function eliminarUsuarioPorDni($usuario);

    
}
