<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminControlador extends Controller
{

    public function Logout(){
        // Verifica si el usuario se encuentra logeado en el sistema
        Auth::logout();
        // Retorna la dirección del login una vez que se cierre sesión
        return Redirect()->route('login');
    }
}
