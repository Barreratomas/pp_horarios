<?php

namespace App\Http\Controllers;

use App\Services\AulaService;
use Illuminate\Http\Request;

class AulaController extends Controller
{
    protected $aulaService;

    public function __construct(AulaService $aulaService){
        $this->aulaService = $aulaService;
    }

   
    public function index(){
        $aulas = $this->aulaService->obtenerTodasAulas();
        return view('aula.index', compact('aulas'));
    }


   
   
    public function obtenerAula(Request $request){
        $id = $request->input('id');
        $aula = $this->aulaService->obtenerAula($id);
        return view('aula.show', compact('aula'));
    }


  
    public function guardarAula(Request $request){
        $nombre = $request->input('nombre');
        $capacidad = $request->input('capacidad');
        $tipo_aula = $request->input('tipo_aula');

        $response=$this->aulaService->guardarAula($nombre,$capacidad,$tipo_aula);
        if (isset($response['success'])) {
            return redirect()->route('aula.index')->with('success', $response['success']);
        } else {
            return redirect()->route('aula.index')->withErrors(['error' => $response['error']]);
        };
    }


    public function actualizarAula(Request $request){
        $id = $request->input('id');
        $nombre = $request->input('nombre');
        $capacidad = $request->input('capacidad');        
        $tipo_aula = $request->input('tipo_aula');
        $response=$this->aulaService->actualizarAula($id,$nombre,$capacidad,$tipo_aula);
        if (isset($response['success'])) {
            return redirect()->route('aula.index')->with('success', $response['success']);
        } else {
            return redirect()->route('aula.index')->withErrors(['error' => $response['error']]);
        };    }


    public function eliminarAula(Request $request){
        $id = $request->input('id');
        $response=$this->aulaService->eliminarAula($id);
        if (isset($response['success'])) {
            return redirect()->route('aula.index')->with('success', $response['success']);
        } else {
            return redirect()->route('aula.index')->withErrors(['error' => $response['error']]);
        };
    }
//-------------------------------------------------------------------------------------------------------------
    // Swagger Documentation

    /**
     * @OA\Get(
     *      path="/api/aulas",
     *     summary="Obtener todas las aulas",
     *     description="Devuelve todas las aulas",
     *     operationId="getAulas",
     *     tags={"Aula"},
     *     @OA\Response(
     *          response=200,
     *          description="Aulas",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(ref="#/components/schemas/Aula")
     *          )
     *      ),
     *     @OA\Response(
     *          response=500,
     *          description="Error al obtener las aulas"
     *      )
     * )
     */
    public function inicio(){
        return $this->aulaService->obtenerAulas();
    }


    /**
     * @OA\Get(
     *     path="/api/aulas/{id}",
     *     summary="Obtener un aula por id",
     *     description="Obtener un aula por id",
     *     operationId="obtenerAulaPorId",
     *     tags={"Aula"},
     *     @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="Id del aula",
     *     required=true,
     *     @OA\Schema(
     *         type="integer"
     *     )
     *     ),
     *     @OA\Response(
     *     response=200,
     *     description="Aula obtenida correctamente",
     *     @OA\JsonContent(ref="#/components/schemas/Aula")
     *     ),
     *     @OA\Response(
     *     response=404,
     *     description="No se encontró el aula"
     *  ),
     *     @OA\Response(
     *     response=500,
     *     description="Error al obtener el aula"
     *   )
     * )
     */
    public function show($id){
        return $this->aulaService->obtenerAulaPorId($id);
    }


    /**
     * @OA\Post(
     *     path="/api/aulas",
     *     summary="Guardar un aula",
     *     description="Guardar un aula",
     *     operationId="guardarAula",
     *     tags={"Aula"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/AulaData")
     *     ),
     *     @OA\Response(
     *     response=200,
     *     description="Aula guardada correctamente"
     *  ),
     *     @OA\Response(
     *     response=400,
     *     description="Error al guardar el aula"
     *  )
     * )
     */
    public function store(Request $request){
        return $this->aulaService->guardarAulas($request);
    }


    /**
     * @OA\Put(
     *     path="/api/aulas/actualizar/{id}",
     *     summary="Actualizar un aula",
     *     description="Actualizar un aula",
     *     operationId="actualizarAula",
     *     tags={"Aula"},
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="Id del aula",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/AulaData")
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="Aula actualizada correctamente"
     *     ),
     *     @OA\Response(
     *          response=500,
     *          description="Error al actualizar el aula"
     *     )
     * )
     */
    public function update(Request $request, $id){
        return $this->aulaService->actualizarAulas($request, $id);
    }


    /**
     * @OA\Delete(
     *     path="/api/aulas/eliminar/{id}",
     *     summary="Eliminar un aula",
     *     description="Eliminar un aula",
     *     operationId="eliminarAula",
     *     tags={"Aula"},
     *     @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="Id del aula",
     *     required=true,
     *     @OA\Schema(
     *     type="integer"
     *    )
     *     ),
     *     @OA\Response(
     *     response=200,
     *     description="Aula eliminada correctamente"
     * ),
     *     @OA\Response(
     *     response=500,
     *     description="Error al eliminar el aula"
     * )
     * )
     */
    public function destroy($id){
        return $this->aulaService->eliminarAulas($id);
    }

}
