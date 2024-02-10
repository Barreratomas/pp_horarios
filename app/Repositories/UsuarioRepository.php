<?php

namespace App\Repositories;


interface UsuarioRepository
{
    public function obtenerTodosUsuarios();
    public function obtenerUsuarioPorDni($dni);
    public function guardarUsuario($alumno);
    public function actualizarUsuario($dni,$params);
    public function eliminarUsuarioPorDni($dni);
}
