<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Services\CarreraService;


use Illuminate\Http\Request;

class CarreraController extends Controller
{
    protected $carreraService;

    public function __construct(CarreraService $carreraService)
    {
        $this->carreraService = $carreraService;
    }

    public function index()
    {
        $carreras = $this->carreraService->obtenerTodasCarreras();
        return view('carrera.index', compact('carreras'));
    }

    public function mostrarCarrera(Request $request)
    {
        $id = $request->input('id');
        $carrera = $this->carreraService->obtenerCarreraPorId($id);
        
        return view('#', compact('carrera'));
    }

    public function crear()
    {
        return view('carrera.crearCarrera');
    }

    public function store(Request $request)
    {
        
        $nombre = $request->input('nombre');

        $response = $this->carreraService->guardarCarrera($nombre);
        if (isset($response['success'])) {
            return redirect()->route('indexCarrera')->with('success', $response['success']);
        } else {
            return redirect()->route('indexCarrera')->withErrors(['error' => $response['error']]);
        }
    }

    public function formularioActualizar( Carrera $carrera){
        return view('carrera.actualizarCarrera', compact('carrera'));
    }
    public function actualizar(Request $request,Carrera $carrera)
    {
        $nombre = $request->input('nombre');


        $response = $this->carreraService->actualizarCarrera($nombre,$carrera);
        if (isset($response['success'])) {
            return redirect()->route('indexCarrera')->with('success', $response['success']);
        } else {
            return redirect()->route('indexCarrera')->withErrors(['error' => $response['error']]);
        }
    }

    public function eliminar(Carrera $carrera)
    {

        $response = $this->carreraService->eliminarCarreraPorId($carrera);
        if (isset($response['success'])) {
            return redirect()->route('indexCarrera')->with('success', $response['success']);
        } else {
            return redirect()->route('indexCarrera')->withErrors(['error' => $response['error']]);
        }
    }


     //---------------------------------------------------------------------------------------------------------
    // Swagger

    /**
     * @OA\Get(
     *     path="/api/carreras",
     *     summary="Obtener todas las carreras",
     *     description="Devuelve todas las carreras",
     *     operationId="getCambiosDocente",
     *     tags={"Carrera"},
     *     @OA\Response(
     *     response=200,
     *     description="Carreras",
     *     @OA\JsonContent(
     *     type="array",
     *     @OA\Items(ref="#/components/schemas/Carrera")
     *   )
     * ),
     *     @OA\Response(
     *     response=500,
     *     description="Error al obtener las carreras"
     * )
     * )
     */
    public function obtenerTodosCarreraSwagger(){
        return $this->carreraService->obtenerTodosCarreraSwagger();
    }

    /**
     * @OA\Get(
     *     path="/api/carreras/{id}",
     *     summary="Obtener una carrera por id",
     *     description="Devuelve una carrera",
     *     operationId="getCambioDocentePorId",
     *     tags={"Carrera"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la carrera",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *     response=200,
     *     description="Carrera",
     *     @OA\JsonContent(ref="#/components/schemas/Carrera")
     * ),
     *     @OA\Response(
     *     response=404,
     *     description="No existe la carrera"
     * ),
     *     @OA\Response(
     *     response=500,
     *     description="Error al obtener la carrera"
     * )
     * )
     */
    public function obtenerCarreraPorIdSwagger($id){
        return $this->carreraService->obtenerCarreraPorIdSwagger($id);
    }

    /**
     * @OA\Post(
     *     path="/api/carreras/guardar",
     *     summary="Guardar una carrera",
     *     description="Guardar una carrera",
     *     operationId="guardarCambioDocente",
     *     tags={"Carrera"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Carrera")
     *     ),
     *     @OA\Response(
     *     response=200,
     *     description="Carrera guardada correctamente",
     *     @OA\JsonContent(ref="#/components/schemas/Carrera")
     * ),
     *     @OA\Response(
     *     response=500,
     *     description="Error al guardar la carrera"
     * )
     * )
     */
    public function guardarCarreraSwagger($Request){
        return $this->carreraService->guardarCarreraSwagger($Request);
    }

    /**
     * @OA\Put(
     *     path="/api/carreras/actualizar/{id}",
     *     summary="Actualizar una carrera",
     *     description="Actualizar una carrera",
     *     operationId="actualizarCambioDocente",
     *     tags={"Carrera"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la carrera",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Carrera")
     *     ),
     *     @OA\Response(
     *     response=200,
     *     description="Carrera actualizada correctamente",
     *     @OA\JsonContent(ref="#/components/schemas/Carrera")
     * ),
     *     @OA\Response(
     *     response=404,
     *     description="No existe la carrera"
     * ),
     *     @OA\Response(
     *     response=500,
     *     description="Error al actualizar la carrera"
     * )
     * )
     */
    public function actualizarCarreraSwagger($Request, $id){
        return $this->carreraService->actualizarCarreraSwagger($Request, $id);
    }

    /**
     * @OA\Delete(
     *     path="/api/carreras/eliminar/{id}",
     *     summary="Eliminar una carrera",
     *     description="Eliminar una carrera",
     *     operationId="eliminarCambioDocentePorId",
     *     tags={"Carrera"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la carrera",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *     response=200,
     *     description="Carrera eliminada correctamente"
     * ),
     *     @OA\Response(
     *     response=404,
     *     description="No existe la carrera"
     * ),
     *     @OA\Response(
     *     response=500,
     *     description="Error al eliminar la carrera"
     * )
     * )
     */
    public function eliminarCarreraPorIdSwagger($id){
        return $this->carreraService->eliminarCarreraPorIdSwagger($id);
    }
}
