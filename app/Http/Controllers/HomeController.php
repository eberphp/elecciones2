<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\UserController;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $perfil = Perfil::find(auth()->user()->idPerfil);

        if ($perfil->tipo == 'admin') {
            return redirect()->route('usuarios.admin');
        } else {
            if ($perfil->tipo == 'empresa') {
                return redirect()->route('datos.empresa');
            }
        }
        
        
    }
}
