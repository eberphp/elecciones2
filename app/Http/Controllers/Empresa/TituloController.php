<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Titulo;

class TituloController extends Controller
{
    public function actualizaTituloTestimonio(Request $request){
        $titulo = Titulo::where('idUsuario', auth()->user()->id)->first();
        $titulo->titleTestimonio = $request->titleTestimonio;
        $titulo->tituloTestimonioVisible = $request->tituloTestimonioVisible;
        $titulo->save();

        return back();
    }

    public function actualizarTituloServicio(Request $request){
        $titulo = Titulo::where('idUsuario', auth()->user()->id)->first();
        $titulo->titleServicio = $request->titleServicio;
        $titulo->tituloServicioVisible = $request->tituloServicioVisible;
        $titulo->save();

        return back();
    }
}
