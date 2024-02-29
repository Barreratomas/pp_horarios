<?php
namespace App\Http\Controllers;

use App\Models\Materia;
use Illuminate\Http\Request;
use App\Services\MateriaService;

class MateriaController extends Controller
{
    protected $materiaService;

    public function __construct(MateriaService $materiaService)
    {
        $this->materiaService = $materiaService;
    }

    public function index()
    {
        $materias = $this->materiaService->obtenerTodasMaterias();
        return view('materia.index', compact('materias'));
    }

    public function mostrarMateria(Request $request)
    {   $id=$request->input("id"); 
        $materia = $this->materiaService->obtenerMateriaPorId($id);
        return view('#', compact('materia'));
    }

    
    public function crear(){
        return view('materia.crearMateria');
    }
    

    public function store(Request $request)
    {   
        $nombre=$request->input('nombre');
        $modulos_semanales=$request->input('modulos_semanales');

        $response = $this->materiaService->guardarMateria($nombre,$modulos_semanales);
        if (isset($response['success'])) {
            return redirect()->route('indexMateria')->with('success', $response['success']);
        } else {
            return redirect()->route('indexMateria')->withErrors(['error' => $response['error']]);
        }
    }

    public function formularioActualizar(Materia $materia)
    {
        return view('materia.actualizarMateria',compact('materia'));
    }
   
    public function actualizar(Request $request, Materia $materia)
    {
        $nombre=$request->input('nombre');
        $modulos_semanales=$request->input('modulos_semanales');

        $response = $this->materiaService->actualizarMateria($nombre,$modulos_semanales,$materia);
        if (isset($response['success'])) {
            return redirect()->route('indexMateria')->with('success', $response['success']);
        } else {
            return redirect()->route('indexMateria')->withErrors(['error' => $response['error']]);
        }
    }

    public function eliminar(Materia $materia)
    {        
        
 

        $response = $this->materiaService->eliminarMateriaPorId($materia);
        if (isset($response['success'])) {
            return redirect()->route('indexMateria')->with('success', $response['success']);
        } else {
            return redirect()->route('indexMateria')->withErrors(['error' => $response['error']]);
        }
    }
    
    //---------------------------------------------------------------------------------------------------------------------
    // Swagger

    /**
     * @OA\Get(
     *     path="/api/materias",
     *     tags={"Materias"},
     *     summary="Obtener todas las materias",
     *     description="Devuelve un array de materias",
     *     @OA\Response(
     *         response=200,
     *         description="Operación exitosa"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error al obtener las materias"
     *     )
     * )
     */
    public function obtenerTodasMateriasSwagger(){
        return $this->materiaService->obtenerTodasMateriasSwagger();
    }

    /**
     * @OA\Get(
     *     path="/api/materias/{id}",
     *     tags={"Materias"},
     *     summary="Obtener materia por id",
     *     description="Devuelve una materia",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la materia",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Operación exitosa"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="No se encontró la materia"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error al obtener la materia"
     *     )
     * )
     */
    public function obtenerMateriaPorIdSwagger($id){
        return $this->materiaService->obtenerMateriaPorIdSwagger($id);

    }

    /**
     * @OA\Post(
     *     path="/api/materias/guardar",
     *     tags={"Materias"},
     *     summary="Guardar materia",
     *     description="Guarda una materia",
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="nombre",
     *                 type="string"
     *             ),
     *             @OA\Property(
     *                 property="modulos_semanales",
     *                 type="integer"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Operación exitosa"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error al guardar la materia"
     *     )
     * )
     */
    public function guardarMateriaSwagger($nombre,$modulos_semanales){
        return $this->materiaService->guardarMateriaSwagger($nombre,$modulos_semanales);
    }

    /**
     * @OA\Put(
     *     path="/api/materias/actualizar/{id}",
     *     tags={"Materias"},
     *     summary="Actualizar materia",
     *     description="Actualiza una materia",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la materia",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="nombre",
     *                 type="string"
     *             ),
     *             @OA\Property(
     *                 property="modulos_semanales",
     *                 type="integer"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Operación exitosa"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="No se encontró la materia"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error al actualizar la materia"
     *     )
     * )
     */
    public function actualizarMateriaSwagger($id,$nombre,$modulos_semanales){
        return $this->materiaService->actualizarMateriaSwagger($id,$nombre,$modulos_semanales);
    }

    /**
     * @OA\Delete(
     *     path="/api/materias/eliminar/{id}",
     *     tags={"Materias"},
     *     summary="Eliminar materia",
     *     description="Elimina una materia",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la materia",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Operación exitosa"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="No se encontró la materia"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error al eliminar la materia"
     *     )
     * )
     */
    public function eliminarMateriaPorIdSwagger($id){
        return $this->materiaService->eliminarMateriaPorIdSwagger($id);
    }
}