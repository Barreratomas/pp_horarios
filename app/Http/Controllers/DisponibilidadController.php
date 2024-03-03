<?php

namespace App\Http\Controllers;

use App\Models\Aula;
use App\Models\Comision;
use App\Models\Disponibilidad;
use App\Models\DocenteMateria;
use App\Models\HorarioPrevioDocente;
use App\Models\Materia;
use App\Services\DisponibilidadService;
use DateInterval;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DisponibilidadController extends Controller
{
    protected $disponibilidadService;

    public function __construct(DisponibilidadService $disponibilidadService)
    {
        $this->disponibilidadService = $disponibilidadService;
    }

    public function index()
    {
        $disponibilidades = $this->disponibilidadService->obtenerTodasDisponibilidades();
        return view('disponibilidad.index', compact('disponibilidades'));
    }

    public function mostrarDisponibilidad(Request $request)
    {
        $id = $request->input('id');
        $disponibilidad = $this->disponibilidadService->obtenerDisponibilidadPorId($id);
        
        return view('disponibilidad.show', compact('disponibilidad'));
    }

   


   


    public function store()
    {   


        // Obtener los modulos_semanales directamente desde la tabla Materias usando el id_dm
        $DocenteMateria = DocenteMateria::orderBy('id_dm', 'desc')->first();
        $id_dm=$DocenteMateria->id_dm;
        $modulos_semanales = Materia::where('id_materia', $DocenteMateria->id_materia)->value('modulos_semanales');

        $id_aula = Aula::where("id_aula",$DocenteMateria->id_aula)->value('id_aula');
        $id_comision = Comision::where("id_comision",$DocenteMateria->id_comision)->value('id_comision');

            

        // Obtener el id_h_p_d más reciente
        $h_p_d = HorarioPrevioDocente::orderBy('id_h_p_d', 'desc')->first();
        $id_h_p_d = $h_p_d->id_h_p_d;
        $diaInstituto = $h_p_d->dia;
        
        $moduloPrevio=$this->disponibilidadService->horaPrevia($id_h_p_d);

        
        $distribucion=$this->disponibilidadService->modulosRepartidos($modulos_semanales,$moduloPrevio,$id_dm,$id_comision,$id_aula,$diaInstituto);
        if (empty($distribucion)) {
            return redirect()->route('redireccionarDisponibilidadError')->withErrors(['error' => 'Distribución vacía']);
        }
            
            foreach ($distribucion as $data) {
                $dia=$data['dia'];
                $modulo_inicio=$data['modulo_inicio'];
                $modulo_fin=$data['modulo_fin'];

                $params=[
                    'id_dm'=>$id_dm,
                    'id_h_p_d'=>$id_h_p_d,
                    'dia'=>$dia,
                    'modulo_inicio'=>$modulo_inicio,
                    'modulo_fin'=>$modulo_fin,
        
                ];

                // dd($params);        
                $response = $this->disponibilidadService->guardarDisponibilidad($params);
                

               
            }
            if($response && isset($response['success'])) {
                
                return redirect()->route('storeHorario')->with('success', $response['success']);
            }else{
                return redirect()->route('redireccionarDisponibilidadError')->withErrors(['error' => $response['error']]);

            }
               
    }


    
    public function redireccionarError(){
        return view("disponibilidad.error");
    }


    
    public function actualizar(Request $request)
    {   
        $id=$request->input("id");

        $params=[
            'id_dm'=>$request->input("id_dm"),
            'id_dm'=>$request->input("id_h_p_d"),
            'dia'=>$request->input("dia"),
            'modulo_inicio'=>$request->input("modulo_inicio"),
            'modulo_fin'=>$request->input("modulo_fin")

        ];
        $response = $this->disponibilidadService->actualizarDisponibilidad($params, $id);
        if (isset($response['success'])) {
            return redirect()->route('disponibilidades.index')->with('success', $response['success']);
        }else{
            return redirect()->route('disponibilidades.index')->withErrors(['error' => $response['error']]);
        }
    
    }

    public function eliminar(Request $request)
    {
        $id = $request->input('id');
        $response = $this->disponibilidadService->eliminarDisponibilidadPorId($id);
        if (isset($response['success'])) {
            return redirect()->route('disponibilidades.index')->with('success', $response['success']);
        }else{
            return redirect()->route('disponibilidades.index')->withErrors(['error' => $response['error']]);

        }
    }

    //-------------------------------------------------------------------------------------------------------------------------
    // swagger

    /**
     * @OA\Get(
     *     path="/api/disponibilidad",
     *     tags={"Disponibilidad"},
     *     summary="Obtener todas las disponibilidades",
     *     @OA\Response(
     *         response=200,
     *         description="Devuelve todas las disponibilidades"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="No se encontraron disponibilidades"
     *     )
     * )
     */
    public function obtenerTodasDisponibilidadesswagger()
    {
        return $this->disponibilidadService->obtenerTodasDisponibilidadesswagger();
    }

    /**
     * @OA\Get(
     *     path="/api/disponibilidad/{id}",
     *     tags={"Disponibilidad"},
     *     summary="Obtener disponibilidad por id",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la disponibilidad",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Devuelve la disponibilidad"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="No se encontró la disponibilidad"
     *     )
     * )
     */
    public function obtenerDisponibilidadPorIdswagger($id)
    {
        return $this->disponibilidadService->obtenerDisponibilidadPorIdswagger($id);
    }

    /**
     * @OA\Post(
     *     path="/api/disponibilidad/guardar",
     *     tags={"Disponibilidad"},
     *     summary="Guardar disponibilidad",
     *     @OA\RequestBody(
     *         @OA\JsonContent(ref="#/components/schemas/Disponibilidad")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Disponibilidad guardada correctamente"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error al guardar la disponibilidad"
     *     )
     * )
     */
    public function guardarDisponibilidadswagger(Request $request)
    {
        return $this->disponibilidadService->guardarDisponibilidadswagger($request);
    }

    /**
     * @OA\Put(
     *     path="/api/disponibilidad/actualizar/{id}",
     *     tags={"Disponibilidad"},
     *     summary="Actualizar disponibilidad",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la disponibilidad",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         @OA\JsonContent(ref="#/components/schemas/Disponibilidad")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Disponibilidad actualizada correctamente"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error al actualizar la disponibilidad"
     *     )
     * )
     */
    public function actualizarDisponibilidadswagger(Request $request, $id)
    {
        return $this->disponibilidadService->actualizarDisponibilidadswagger($request, $id);
    }

    /**
     * @OA\Delete(
     *     path="/api/disponibilidad/eliminar/{id}",
     *     tags={"Disponibilidad"},
     *     summary="Eliminar disponibilidad por id",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la disponibilidad",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Disponibilidad eliminada correctamente"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error al eliminar la disponibilidad"
     *     )
     * )
     */
    public function  eliminarDisponibilidadPorIdswagger($id)
    {
        return $this->disponibilidadService->eliminarDisponibilidadPorIdswagger($id);
    }
}
