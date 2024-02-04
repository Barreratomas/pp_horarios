<?php

namespace App\Services;

use App\Repositories\UsuarioRepository;
use App\Mappers\UsuarioMapper;
use App\Models\Usuario;
use App\Validate\UsuarioValidate;
use Exception;
use Illuminate\Support\Facades\Log;


class UsuarioService implements UsuarioRepository
{

    protected $usuarioMapper;
    protected $usuarioValidate;

    public function __construct(UsuarioMapper $usuarioMapper, UsuarioValidate $usuarioValidate)
    {
        $this->usuarioMapper = $usuarioMapper;
        $this->usuarioValidate = $usuarioValidate;
    }


    public function obtenerTodosUsuarios()
    {
        try {
            $usuarios = Usuario::all();
            return response()->json($usuarios, 200);
        } catch (Exception $e) {
            Log::error('Error al obtener los usuarios: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al obtener los usuarios'], 500);
        }

    }

    public function obtenerUsuarioPorDni($dni)
    {
        $usuario = Usuario::find($dni);
        if (!$usuario) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }
        try {
            return response()->json($usuario, 200);
        } catch (Exception $e) {
            Log::error('Error al obtener el usuario: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al obtener el usuario'], 500);
        }
    }

    public function guardarUsuario($usuarioData)
    {
        if ($this->usuarioValidate->emailExiste($usuarioData['email'])) {
            return response()->json(['error' => 'El email ya existe'], 400);
        }
        try {
            $usuario = $this->usuarioMapper->toUsuario($usuarioData);
            $usuario->save();
            return response()->json(['success' => 'Usuario guardado correctamente'], 200);
        } catch (Exception $e) {
            Log::error('Error al guardar el usuario: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al guardar el usuario'], 500);

        }
    }

    public function actualizarUsuario($request, $dni, $pass=false)
    {
        $usuario = Usuario::find($dni);
        if (!$usuario) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        } elseif ($this->usuarioValidate->emailExiste($request->input('email'))) {
            return response()->json(['error' => 'El email ya existe'], 400);
        }
        try {
            $usuario->update($this->usuarioMapper->toUsuarioData($request, (!$pass) ? $request->input('contrasenia') : $usuario->contrasenia));
            return response()->json(['success' => 'Usuario actualizado correctamente'], 200);
        } catch (Exception $e) {
            Log::error('Error al actualizar el usuario: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al actualizar el usuario'], 500);
        }
    }

    public function actualizarContrasenia($request, $dni)
    {
        $usuario = Usuario::find($dni);
        if (!$usuario) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }elseif ($this->usuarioValidate->emailExiste($request->input('email'))) {
            return response()->json(['error' => 'El email ya existe'], 400);
        }
        try {
            $usuario->update([
                'contrasenia' => $request->input('contrasenia')
            ]);
            return response()->json(['success' => 'Usuario actualizado correctamente'], 200);
        } catch (Exception $e) {
            Log::error('Error al actualizar el usuario: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al actualizar el usuario'], 500);
        }
    }

    public function eliminarUsuarioPorDni($dni)
    {
        $usuario = Usuario::find($dni);
        if (!$usuario) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }
        try {
            $usuario->delete();
            return response()->json(['success' => 'Usuario eliminado correctamente'], 200);
        } catch (Exception $e) {
            Log::error('Error al eliminar el usuario: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al eliminar el usuario'], 500);
        }
    }
}
