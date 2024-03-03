<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioRequest;
use App\Models\Carrera;
use App\Models\Comision;
use App\Models\Usuario;
use Illuminate\Http\Request;
use App\Services\UsuarioService;
use Illuminate\Support\Facades\Redis;

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

    
    public function store(UsuarioRequest $request)
    {
        
        $params = [
            'dni' =>  $request->input('dni'),
            'nombre' =>  $request->input('nombre'),
            'apellido' =>  $request->input('apellido'),
            'tipo' =>  $request->input('tipo'),
            'email' =>  $request->input('email'),
            'id_carrera' =>  $request->input('id_carrera'),
            'anio' => $request->input('anio')


        ];
        

        $response = $this->usuarioService->guardarUsuario($params);
        if (isset($response['success'])) {
            return redirect()->route('indexUsuario')->with('success', $response['success']);
        } else {
            return redirect()->route('indexUsuario')->withErrors(['error' => $response['error']]);
        }
    }

    public function formularioActualizar(Usuario $usuario) {
        $carreras=Carrera::all();
        $comisiones=Comision::all();
        return view('usuario.actualizarUsuario',compact('usuario','carreras','comisiones'));
    }

    public function actualizar(UsuarioRequest $request, Usuario $usuario)
    {   
        $params = [
            
            'nombre' =>  $request->input('nombre'),
            'apellido' =>  $request->input('apellido'),
            'tipo' =>  $request->input('tipo'),
            'email' =>  $request->input('email'),
            'id_carrera' =>  $request->input('id_carrera'),
            'id_comision' =>  $request->input('id_comision'),
        ];

        $response = $this->usuarioService->actualizarUsuario($params,$usuario);
        if (isset($response['success'])) {
            return redirect()->route('indexUsuario')->with('success', $response['success']);
        } else {
            return redirect()->route('indexUsuario')->withErrors(['error' => $response['error']]);
        }
    }

   

    

    public function eliminar(Usuario $usuario)
    {
        $response = $this->usuarioService->eliminarUsuarioPorDni($usuario);
        if (isset($response['success'])) {
            return redirect()->route('indexUsuario')->with('success', $response['success']);
        } else {
            return redirect()->route('indexUsuario')->withErrors(['error' => $response['error']]);
        }
    }
}
