<?php

namespace App\Http\Controllers;

use App\Models\HorarioPrevioDocente;
use Illuminate\Http\Request;

class HorarioPrevioDocenteController extends Controller
{
    public function index()
    {
        $horariosPrevios = HorarioPrevioDocente::all();
        return view('horarios_previos.index', compact('horariosPrevios'));

    }

    public function actualizar(Request $request)
    {
        $id=$request->input("id");
        $dni_docente=$request->input("dni_docente");
        $dia=$request->input("dia");
        $hora=$request->input("hora");

        $horarioPrevioDocente = HorarioPrevioDocente::find($id);

        $horarioPrevioDocente->id= $id;
        $horarioPrevioDocente->dni_docente = $dni_docente;
        $horarioPrevioDocente->dia = $dia;
        $horarioPrevioDocente->hora = $hora;    

        $horarioPrevioDocente->save();
        return view('horarios_previos.index');

    }


    public function store(Request $request)
    {
        $horarioPrevioDocente = new HorarioPrevioDocente();
        $dni_docente=$request->input("dni_docente");
        $dia=$request->input("dia");
        $hora=$request->input("hora");
        
        $horarioPrevioDocente->dni_docente = $dni_docente;
        $horarioPrevioDocente->dia = $dia;
        $horarioPrevioDocente->hora = $hora;    

        $horarioPrevioDocente->save();

        return view('horarios_previos.index');

    }


    public function eliminar(Request $request)
    {
        $id=$request->input("id");
        $horarioPrevioDocente = HorarioPrevioDocente::find($id);
        $horarioPrevioDocente->delete();

        return view('horarios_previos.index');

    }


}
