<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\Comision;
use App\Models\Usuario;
use Illuminate\Http\Request;
use App\Services\UsuarioService;

class UsuarioController extends Controller
{
    protected $usuarioService;

    public function __construct(UsuarioService $usuarioService)
    {
        $this->usuarioService = $usuarioService;
    }

    public function index()
    {
        $usuarios = $this->usuarioService->obtenerTodosUsuarios();
        return view('usuario.index', compact('usuarios'));
    }

    public function mostrarUsuario(Request $request)
    {
        $dni=$request->input('dni');
        $usuario = $this->usuarioService->obtenerUsuarioPorDni($dni);
        return view('usuario.show', compact('usuario'));
    }

    public function crear(){
        $carreras=Carrera::all();
        $comisiones=Comision::all();
        return view('usuario.crearUsuario',compact('carreras','comisiones'));
    }

    
    public function store(Request $request)
    {
        $params = [
            'dni' =>  $request->input('dni'),
            'nombre' =>  $request->input('nombre'),
            'apellido' =>  $request->input('apellido'),
            'tipo' =>  $request->input('tipo'),
            'email' =>  $request->input('email'),
            'id_carrera' =>  $request->input('id_carrera'),
            'id_comision' =>  $request->input('id_comision'),


        ];

        $response = $this->usuarioService->guardarUsuario($params);
        if (isset($response['success'])) {
            return redirect()->route('indexUsuario')->with('success', $response['success']);
        } else {
            return redirect()->route('indexUsuario')->withErrors(['error' => $response['error']]);
        }
    }

    public function formularioActualizar(Usuario $usuario) {
        return view('usuario.actualizarUsuario',compact('usuario'));
    }

    public function actualizar(Request $request)
    {   
        $dni=$request->input('dni');
        $params = [
            'nombre' =>  $request->input('nombre'),
            'apellido' =>  $request->input('apellido'),
            'email' =>  $request->input('email'),
            'id_carrera' =>  $request->input('id_carrera'),
            'id_comision' =>  $request->input('id_comision'),
    ];

        $response = $this->usuarioService->actualizarUsuario($dni,$params);
        if (isset($response['success'])) {
            return redirect()->route('usuario.index')->with('success', $response['success']);
        } else {
            return redirect()->route('usuario.index')->withErrors(['error' => $response['error']]);
        }
    }

   

    

    public function eliminar(Request $request)
    {
        $dni=$request->input('dni');
        $response = $this->usuarioService->eliminarUsuarioPorDni($dni);
        if (isset($response['success'])) {
            return redirect()->route('usuario.index')->with('success', $response['success']);
        } else {
            return redirect()->route('usuario.index')->withErrors(['error' => $response['error']]);
        }
    }
}
