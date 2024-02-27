<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function postLogin(Request $request){
         // Lógica de autenticación...

        // Obtener el tipo de usuario del formulario
        $userType = $request->input('userType');

        // Guardar el tipo de usuario en la sesión
        $request->session()->put('userType', $userType);

        // Pasar el tipo de usuario a la vista
        return view('home');
    }

    public function index(Request $request){
      
       return view('home');
   }
}
