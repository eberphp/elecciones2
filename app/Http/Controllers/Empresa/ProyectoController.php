<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use App\Models\Proyecto;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    public function index(Request $request)
    {
        $proyectos = Proyecto::with('encargados:id,email')->with('responsables:id,email')->where('estado','Activo')->get();
        // dd($proyectos);
        return view('intranet.pages.empresa.proyectos.index',[
            'proyectos' => $proyectos,
        ]);
    }
}
