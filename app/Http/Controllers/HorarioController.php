<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use Illuminate\Http\Request;
use App\Services\HorarioService;
use Illuminate\Contracts\View\View;

class HorarioController extends Controller
{
    // protected $horarioService;

    // public function __construct(HorarioService $horarioService){
    //     $this->horarioService = $horarioService;
    // }

    // /**
    //  * @OA\Get(
    //  *      path="/api/horarios",
    //  *     summary="Obtener todos los horarios",
    //  *     description="Devuelve todos los horarios",
    //  *     operationId="getHorarios",
    //  *     tags={"Horario"},
    //  *     @OA\Response(
    //  *          response=200,
    //  *          description="Horarios",
    //  *          @OA\JsonContent(
    //  *              type="array",
    //  *              @OA\Items(ref="#/components/schemas/Horario")
    //  *          )
    //  *      ),
    //  *     @OA\Response(
    //  *          response=500,
    //  *          description="Error al obtener los horarios"
    //  *      )
    //  * )
    //  */
    // public function index()
    // {
    //     return $this->horarioService->obtenerTodosHorarios();
    // }

    // /**
    //  * @OA\Get(
    //  *      path="/api/horarios/{id}",
    //  *     summary="Obtener horario por id",
    //  *     description="Devuelve un horario",
    //  *     operationId="getHorarioPorId",
    //  *     tags={"Horario"},
    //  *     @OA\Parameter(
    //  *          name="id",
    //  *          description="Id del horario",
    //  *          required=true,
    //  *          in="path",
    //  *          @OA\Schema(
    //  *              type="integer"
    //  *          )
    //  *      ),
    //  *     @OA\Response(
    //  *          response=200,
    //  *          description="Horario",
    //  *          @OA\JsonContent(ref="#/components/schemas/Horario")
    //  *      ),
    //  *     @OA\Response(
    //  *          response=404,
    //  *          description="No existe el horario"
    //  *      ),
    //  *     @OA\Response(
    //  *          response=500,
    //  *          description="Error al obtener el horario"
    //  *      )
    //  * )
    //  */
    // public function show($id){
    //     return $this->horarioService->obtenerHorarioPorId($id);
    // }

    // /**
    //  * @OA\Post(
    //  *      path="/api/horarios/guardar",
    //  *     summary="Guardar horario",
    //  *     description="Guardar un horario",
    //  *     operationId="guardarHorario",
    //  *     tags={"Horario"},
    //  *     @OA\RequestBody(
    //  *          description="Horario a guardar",
    //  *          required=true,
    //  *          @OA\JsonContent(ref="#/components/schemas/HorarioData")
    //  *      ),
    //  *     @OA\Response(
    //  *          response=201,
    //  *          description="Horario creado",
    //  *          @OA\JsonContent(ref="#/components/schemas/HorarioData")
    //  *      ),
    //  *     @OA\Response(
    //  *          response=500,
    //  *          description="Error al guardar el horario"
    //  *      )
    //  * )
    //  */
    // public function store(Request $request)
    // {
    //     return $this->horarioService->guardarHorario($request);
    // }

    // /**
    //  * @OA\Put(
    //  *      path="/api/horarios/actualizar/{id}",
    //  *     summary="Actualizar horario",
    //  *     description="Actualizar un horario",
    //  *     operationId="actualizarHorario",
    //  *     tags={"Horario"},
    //  *     @OA\Parameter(
    //  *          name="id",
    //  *          description="Id del horario",
    //  *          required=true,
    //  *          in="path",
    //  *          @OA\Schema(
    //  *              type="integer"
    //  *          )
    //  *      ),
    //  *     @OA\RequestBody(
    //  *          description="Horario a actualizar",
    //  *          required=true,
    //  *          @OA\JsonContent(ref="#/components/schemas/HorarioData")
    //  *      ),
    //  *     @OA\Response(
    //  *          response=200,
    //  *          description="Horario actualizado",
    //  *          @OA\JsonContent(ref="#/components/schemas/HorarioData")
    //  *      ),
    //  *     @OA\Response(
    //  *          response=404,
    //  *          description="No existe el horario"
    //  *      ),
    //  *     @OA\Response(
    //  *          response=500,
    //  *          description="Error al actualizar el horario"
    //  *      )
    //  * )
    //  */
    // public function update(Request $request, $id){
    //     return $this->horarioService->actualizarHorario($request, $id);
    // }

    // /**
    //  * @OA\Delete(
    //  *      path="/api/horarios/eliminar/{id}",
    //  *     summary="Eliminar horario",
    //  *     description="Eliminar un horario",
    //  *     operationId="eliminarHorario",
    //  *     tags={"Horario"},
    //  *     @OA\Parameter(
    //  *          name="id",
    //  *          description="Id del horario",
    //  *          required=true,
    //  *          in="path",
    //  *          @OA\Schema(
    //  *              type="integer"
    //  *          )
    //  *      ),
    //  *     @OA\Response(
    //  *          response=200,
    //  *          description="Horario eliminado",
    //  *          @OA\JsonContent(ref="#/components/schemas/HorarioData")
    //  *      ),
    //  *     @OA\Response(
    //  *          response=404,
    //  *          description="No existe el horario"
    //  *      ),
    //  *     @OA\Response(
    //  *          response=500,
    //  *          description="Error al eliminar el horario"
    //  *      )
    //  * )
    //  */
    // public function destroy($id)
    // {
    //     return $this->horarioService->eliminarHorarioPorId($id);
    // }

    public function indexController():View{
        $horarios=Horario::all();
        return view('horario',compact('horarios'));
    }

}
