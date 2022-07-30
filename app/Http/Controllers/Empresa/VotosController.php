<?php

namespace App\Http\Controllers\Empresa;

use App\Models\Votos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class VotosController extends Controller
{
    public function index(Request $request)
    {
        $votos = Votos::with('encuesta:idEncuesta,nombreEncuesta,fechaTermino')->with('partido:id,partido,logotipo,observacion')
        ->with('candidato:id,nombresApellidos,foto,observaciones')
        ->select('idVoto','encuestaId','partidoId','candidatoId','region',DB::raw('IFNULL(SUM(votos),0) as votos'),'tipoEncuesta','fecha','estado')
        ->groupBy('encuestaId','partidoId','region')->get();
        
        return view('intranet.pages.empresa.encuestas.votos_encuesta',[
            'votos' => $votos
        ]);
    }
}
