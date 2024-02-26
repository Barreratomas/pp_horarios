<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DocenteService;

class DocenteController extends Controller
{
    protected $docenteService;


    public function __construct(DocenteService $docenteService)
    {
        $this->docenteService = $docenteService;
    }

    public function index()
    {
        $docentes = $this->docenteService->obtenerTodosDocentes();
        return view('docente.index', compact('docentes'));
    }

    public function mostrarDocente(Request $request)
    {
        $dni = $request->input('dni');
        $docente = $this->docenteService->obtenerDocentePorDni($dni);
        
        return view('docente.ind', compact('docente'));
    }

    public function crear(){
        return view('docente.crearDocente');
    }

    public function store(Request $request)
    {
        $dni = $request->input('dni');
        $nombre = $request->input('nombre');
        $apellido = $request->input('apellido');
        $email = $request->input('email');
       

        $response = $this->docenteService->guardarDocente($dni,$nombre,$apellido,$email);
        if (isset($response['success'])) {
            session(['dni' => $dni]);

            return redirect()->route('mostrarFormularioHPD')->with('success', ['message' => $response['success'], 'dni' => $dni]);
        } else {
            return redirect()->route('mostrarFormularioDocente')->withErrors(['error' => $response['error']]);
        }
    }

    public function actualizar(Request $request)
    {
        $dni = $request->input('dni');
        $nombre = $request->input('nombre');
        $apellido = $request->input('apellido');
        $email = $request->input('email');

        $response = $this->docenteService->actualizarDocente($dni,$nombre,$apellido,$email);
        if (isset($response['success'])) {
            return redirect()->route('docente.i')->with('success', $response['success']);
        } else {
            return redirect()->route('docente.i')->withErrors(['error' => $response['error']]);
        }
    }

    public function eliminar(Request $request)
    {
        $dni=$request->input('dni');
        $response = $this->docenteService->eliminarDocentePorDni($dni);
        if (isset($response['success'])) {
            return redirect()->route('docente.i')->with('success', $response['success']);
        } else {
            return redirect()->route('docente.i')->withErrors(['error' => $response['error']]);
        }
    }

    //------------------------------------------------------------------------------------------------------------------
    // Swagger

    /**
     * @OA\Get(
     *     path="/api/docentes",
     *     tags={"Docente"},
     *     summary="Obtener todos los docentes",
     *     description="Devuelve todos los docentes",
     *     operationId="obtenerDocente",
     *     @OA\Response(
     *     response=200,
     *     description="Docentes",
     *     @OA\JsonContent(
     *     type="array",
     *     @OA\Items(ref="#/components/schemas/Docente")
     *   )
     * ),
     *     @OA\Response(
     *     response=500,
     *     description="Error al obtener los docentes"
     * )
     * )
     */
    public function inicio()
    {
        return $this->docenteService->obtenerDocente();
    }

    /**
     * @OA\Get(
     *     path="/api/docentes/{id}",
     *     tags={"Docente"},
     *     summary="Obtener docente por dni",
     *     description="Devuelve un docente",
     *     operationId="obtenerDocentePorDni",
     *     @OA\Parameter(
     *     name="dni",
     *     in="path",
     *     description="DNI del docente",
     *     required=true,
     *     @OA\Schema(
     *     type="string"
     * )
     * ),
     *     @OA\Response(
     *     response=200,
     *     description="Docente",
     *     @OA\JsonContent(ref="#/components/schemas/Docente")
     * ),
     *     @OA\Response(
     *     response=404,
     *     description="Docente no encontrado"
     * ),
     *     @OA\Response(
     *     response=500,
     *     description="Error al obtener el docente"
     * )
     * )
     */
    public function obtenerDocentePorId($id)
    {
        return $this->docenteService->obtenerDocentePorId($id);
    }

    /**
     * @OA\Post(
     *     path="/api/docentes/guardar",
     *     tags={"Docente"},
     *     summary="Guardar docente",
     *     description="Guarda un docente",
     *     operationId="guardarDocente",
     *     @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(ref="#/components/schemas/Docente")
     * ),
     *     @OA\Response(
     *     response=200,
     *     description="Docente guardado correctamente"
     * ),
     *     @OA\Response(
     *     response=500,
     *     description="Error al guardar el docente"
     * )
     * )
     */
        public function guardarDocentes(Request $request)
    {
        $docente = $request->all();
        return $this->docenteService->guardarDocentes($docente);
    }

    /**
     * @OA\Put(
     *     path="/api/docentes/actualizar/{id}",
     *     tags={"Docente"},
     *     summary="Actualizar docente",
     *     description="Actualiza un docente",
     *     operationId="actualizarDocente",
     *     @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="ID del docente",
     *     required=true,
     *     @OA\Schema(
     *     type="string"
     * )
     * ),
     *     @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(ref="#/components/schemas/Docente")
     * ),
     *     @OA\Response(
     *     response=200,
     *     description="Docente actualizado correctamente"
     * ),
     *     @OA\Response(
     *     response=404,
     *     description="Docente no encontrado"
     * ),
     *     @OA\Response(
     *     response=500,
     *     description="Error al actualizar el docente"
     * )
     * )
     */
    public function actualizarDocentes(Request $request, $id)
    {
        $docente = $request->all();
        return $this->docenteService->actualizarDocentes($docente, $id);
    }

    /**
     * @OA\Delete(
     *     path="/api/docentes/eliminar/{id}",
     *     tags={"Docente"},
     *     summary="Eliminar docente",
     *     description="Elimina un docente",
     *     operationId="eliminarDocente",
     *     @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="ID del docente",
     *     required=true,
     *     @OA\Schema(
     *     type="string"
     * )
     * ),
     *     @OA\Response(
     *     response=200,
     *     description="Docente eliminado correctamente"
     * ),
     *     @OA\Response(
     *     response=404,
     *     description="Docente no encontrado"
     * ),
     *     @OA\Response(
     *     response=500,
     *     description="Error al eliminar el docente"
     * )
     * )
     */
    public function eliminarDocentes($id)
    {
        return $this->docenteService->eliminarDocentes($id);
    }
}











