<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use App\Models\DocenteMateria;
use App\Models\HorarioPrevioDocente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AsignacionController extends Controller
{
    public function index()
    {
        $docentes = Docente::all();
        return view('asignacion.index', compact('docentes'));
    }

    public function eliminar(HorarioPrevioDocente $h_p_d, DocenteMateria $dm)
    {
        try {
            DB::beginTransaction();

            $h_p_d->delete();
            $dm->delete();

            DB::commit();

            return redirect()->route('indexAsignacion')->with('success', 'Materia eliminada correctamente');

        } catch (\Exception $e) {
            DB::rollBack();

            // Manejar la excepción, por ejemplo, devolver un mensaje de error
            return redirect()->back()->withErrors(['error' => 'Hubo un error al eliminar la materia']);
        }

    }
}