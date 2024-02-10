<?php

namespace App\Http\Controllers;

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
        return  view('comision.show',compact('comision'));
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
            return redirect()->route('comision.index')->with('success', $response['success']);
           
        }else{
    
            // Si hubo un error al actualizar la comisión, redirigir con un mensaje de error
            return redirect()->route('comision.index')->withErrors(['error' => $response['error']]);
        }
            
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
            return redirect()->route('comisiones.index')->with('success', $response['success']);
           
        }else{
    
            // Si hubo un error al actualizar la comisión, redirigir con un mensaje de error
            return redirect()->route('comisiones.index')->withErrors(['error' => $response['error']]);
        }
    }

   
    public function eliminar(Request $request)
    {
        $id=$request->input('id');
        $response = $this->comisionService->eliminarComisionPorId($id);
        
        // Verificar si se eliminó la comisión correctamente
        if (isset($response['success'])) {
            // Si se eliminó correctamente, redirigir  con un mensaje de éxito
            return redirect()->route('comisiones.index')->with('success', $response['success']);
        } else {
            // Si hubo un error al eliminar la comisión, redirigir con un mensaje de error
            return redirect()->route('comisiones.index')->withErrors(['error' => $response['error']]);
        }
    }
}

