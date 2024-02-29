<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\Comision;
use Illuminate\Http\Request;
use App\Services\ComisionService;

class ComisionController extends Controller
{
    protected $comisionService;

    public function __construct(ComisionService $comisionService){
        $this->comisionService = $comisionService;
    }

  
    public function index(){
        $comisiones = $this->comisionService->obtenerTodasComisiones();
        return view('comision.index',compact('comisiones'));
    }

   
    

  
    public function mostrarComision(Request $request)
    {   
        $id = $request->input('id');
        $comision = $this->comisionService->obtenerComisionPorId($id);
        return  view('#',compact('comision'));
    }

    public function crear()
    {
        $carreras=Carrera::all();
        return view('comision.crearComision',compact('carreras'));
    } 
   
    public function store(Request $request){
        $anio = $request->input('anio');
        $division = $request->input('division');
        $id_carrera = $request->input('id_carrera');
        $capacidad = $request->input('capacidad');
        $response=$this->comisionService->guardarComision($anio,$division,$id_carrera,$capacidad);
        
         // Verificar si se actualizó correctamente
         if (isset($response['success'])) {
            // Si se actualizo correctamente, redirigir con un mensaje de éxito
            return redirect()->route('indexComision')->with('success', $response['success']);
           
        }else{
    
            // Si hubo un error al actualizar la comisión, redirigir con un mensaje de error
            return redirect()->route('indexComision')->withErrors(['error' => $response['error']]);
        }
            
    }
        
    
    public function formularioActualizar(Comision $comision){
    return view('comision.actualizarComision',compact('comision'));
    }

    public function actualizar(Request $request)
    {
        // Obtener los datos del Request
        $id = $request->input('id');
        $anio = $request->input('anio');
        $division = $request->input('division');
        $id_carrera = $request->input('id_carrera');
        $capacidad = $request->input('capacidad');


        // Llamar al servicio para actualizar la comisión
        $response = $this->comisionService->actualizarComision($id, $anio,$division,$id_carrera,$capacidad);
        
        // Verificar si se actualizó correctamente
        if (isset($response['success'])) {
            // Si se actualizo correctamente, redirigir con un mensaje de éxito
            return redirect()->route('indexComision')->with('success', $response['success']);
           
        }else{
    
            // Si hubo un error al actualizar la comisión, redirigir con un mensaje de error
            return redirect()->route('indexComision')->withErrors(['error' => $response['error']]);
        }
    }

   
    public function eliminar(Request $request)
    {
        $id=$request->input('id');
        $response = $this->comisionService->eliminarComisionPorId($id);
        
        // Verificar si se eliminó la comisión correctamente
        if (isset($response['success'])) {
            // Si se eliminó correctamente, redirigir  con un mensaje de éxito
            return redirect()->route('indexComision')->with('success', $response['success']);
        } else {
            // Si hubo un error al eliminar la comisión, redirigir con un mensaje de error
            return redirect()->route('indexComision')->withErrors(['error' => $response['error']]);
        }
    }

    
    //------------------------------------------------------------------------------------------------------------------
    // Swagger

    /**
     * @OA\Get(
     *     path="/api/comisiones",
     *     tags={"Comision"},
     *     summary="Obtener todas las comisiones",
     *     description="Devuelve un array de comisiones",
     *     @OA\Response(
     *         response=200,
     *         description="Operación exitosa"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error al obtener las comisiones"
     *     )
     * )
     */
    public function obtenerTodasComisionSwagger(){
        return $this->comisionService->obtenerTodasComisionSwagger();
    }

    /**
     * @OA\Get(
     *     path="/api/comisiones/{id}",
     *     tags={"Comision"},
     *     summary="Obtener comision por id",
     *     description="Devuelve una comision",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Id de la comision",
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
     *         description="No se encontró la comision"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error al obtener la comision"
     *     )
     * )
     */
    public function obtenerComisionPorIdSwagger($id){
        return $this->comisionService->obtenerComisionPorIdSwagger($id);
    }

    /**
     * @OA\Post(
     *     path="/api/comisiones/guardar",
     *     tags={"Comision"},
     *     summary="Guardar comision",
     *     description="Guardar una comision",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Comision")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Operación exitosa"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error al guardar la comision"
     *     )
     * )
     */
    public function guardarComisionSwagger(Request $request){
        return $this->comisionService->guardarComisionSwagger($request);
    }

    /**
     * @OA\Put(
     *     path="/api/comisiones/actualizar/{id}",
     *     tags={"Comision"},
     *     summary="Actualizar comision",
     *     description="Actualizar una comision",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Id de la comision",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Comision")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Operación exitosa"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error al actualizar la comision"
     *     )
     * )
     */
    public function actualizarComisionSwagger(Request $request, $id){
        return $this->comisionService->actualizarComisionSwagger($request, $id);
    }

    /**
     * @OA\Delete(
     *     path="/api/comisiones/eliminar/{id}",
     *     tags={"Comision"},
     *     summary="Eliminar comision por id",
     *     description="Eliminar una comision",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Id de la comision",
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
     *         response=500,
     *         description="Error al eliminar la comision"
     *     )
     * )
     */
    public function eliminarComisionPorIdSwagger($id){
        return $this->comisionService->eliminarComisionPorIdSwagger($id);
    }
}

