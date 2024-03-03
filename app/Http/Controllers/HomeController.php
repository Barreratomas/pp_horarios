<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function postLogin(Request $request){

        // Obtener el tipo de usuario del formulario
        $userType = $request->input('userType');

        // Guardar el tipo de usuario en la sesión
        $request->session()->put('userType', $userType);

        // Pasar el tipo de usuario a la vista
        return view('home');
    }

    public function index(){
      
       return view('home');
    }
    public function logout(Request $request){
        $request->session()->forget('userType');

        // Redirigir al usuario a la página de inicio o a donde desees
        return redirect('/');
    }
}
