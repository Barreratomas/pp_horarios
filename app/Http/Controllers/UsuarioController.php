<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Data\UsuarioData;
use App\Services\UsuarioService;


class UsuarioController extends Controller
{

    protected $usuarioService;

    public function __construct(UsuarioService $usuarioService){
        $this->usuarioService = $usuarioService;
    }

   
    public function index(){
        return $this->usuarioService->obtenerTodosUsuarios();
    }



    
    public function show($dni){
        return $this->usuarioService->obtenerUsuarioPorDni($dni);
    }

   
    public function store(Request $request){
        return $this->usuarioService->guardarUsuario($request);
    }

   
    public function update(Request $request, $dni){
        return $this->usuarioService->actualizarUsuario($request, $dni);
    }

   
    public function updateDatos(Request $request, $dni){
        return $this->usuarioService->actualizarUsuario($request, $dni, true);
    }

    public function updatePassword(Request $request, $dni){
        return $this->usuarioService->actualizarContrasenia($request, $dni);
    }

    
    public function destroy($dni)
    {
        return $this->usuarioService->eliminarUsuarioPorDni($dni);
    }

}
