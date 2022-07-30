<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Candidato;
use Illuminate\Http\Request;

class CandidatoController extends Controller
{
    public function list($departamento, $provincia, $distrito)
    {
        $departamentos = Candidato::query()
            ->select(
                'partidos.id as partido_id',
                'partidos.partido',
                'partidos.logotipo',
                'candidatos.id as candidato_id',
                'candidatos.nombreCorto',
                'candidatos.tipo',
                'candidatos.foto'
            )
            ->join('partidos', 'partidos.id', '=', 'candidatos.idPartido')
            ->where('candidatos.idDepartamento', $departamento)
            ->whereNull('candidatos.idProvincia')
            ->whereNull('candidatos.idDistrito')
            ->where('candidatos.estado', 'activo')
            ->where('partidos.estado', 'activo')
        ;
        $provincias = Candidato::query()
            ->select(
                'partidos.id as partido_id',
                'partidos.partido',
                'partidos.logotipo',
                'candidatos.id as candidato_id',
                'candidatos.nombreCorto',
                'candidatos.tipo',
                'candidatos.foto'
            )
            ->join('partidos', 'partidos.id', '=', 'candidatos.idPartido')
            ->where('candidatos.idDepartamento', $departamento)
            ->where('candidatos.idProvincia', $provincia)
            ->whereNull('candidatos.idDistrito')
            ->where('candidatos.estado', 'activo')
            ->where('partidos.estado', 'activo')
        ;
        $candidatos = Candidato::query()
            ->select(
                'partidos.id as partido_id',
                'partidos.partido',
                'partidos.logotipo',
                'candidatos.id as candidato_id',
                'candidatos.nombreCorto as candidato',
                'candidatos.tipo',
                'candidatos.foto'
            )
            ->join('partidos', 'partidos.id', '=', 'candidatos.idPartido')
            ->where('candidatos.idDepartamento', $departamento)
            ->where('candidatos.idProvincia', $provincia)
            ->where('candidatos.idDistrito', $distrito)
            ->where('candidatos.estado', 'activo')
            ->where('partidos.estado', 'activo')
            ->union($departamentos)
            ->union($provincias)
            ->get()
            ->groupBy('partido_id')
            ->map(function ($item) {
                $candidato_departamento_id = null;
                $candidato_departamento_nombre = null;
                $candidato_departamento_foto = null;
                $candidato_provincia_id = null;
                $candidato_provincia_nombre = null;
                $candidato_provincia_foto = null;
                $candidato_distrito_id = null;
                $candidato_distrito_nombre = null;
                $candidato_distrito_foto = null;
                if($item->where('tipo','Regional')->first()) $candidato_departamento_id = $item->where('tipo','Regional')->first()['candidato_id'];
                if($item->where('tipo','Regional')->first()) $candidato_departamento_nombre = $item->where('tipo','Regional')->first()['candidato'];
                if($item->where('tipo','Regional')->first()) $candidato_departamento_foto = 'http://sice.levelte.com/img/fotos/'.$item->where('tipo','Regional')->first()['foto'];
                if($item->where('tipo','Provincial')->first()) $candidato_provincia_id = $item->where('tipo','Provincial')->first()['candidato_id'];
                if($item->where('tipo','Provincial')->first()) $candidato_provincia_nombre = $item->where('tipo','Provincial')->first()['candidato'];
                if($item->where('tipo','Provincial')->first()) $candidato_provincia_foto = 'http://sice.levelte.com/img/fotos/'.$item->where('tipo','Provincial')->first()['foto'];
                if($item->where('tipo','Distrital')->first()) $candidato_distrito_id = $item->where('tipo','Distrital')->first()['candidato_id'];
                if($item->where('tipo','Distrital')->first()) $candidato_distrito_nombre = $item->where('tipo','Distrital')->first()['candidato'];
                if($item->where('tipo','Distrital')->first()) $candidato_distrito_foto = 'http://sice.levelte.com/img/fotos/'.$item->where('tipo','Distrital')->first()['foto'];
                return [
                    'partido_id'=> $item->first()['partido_id'],
                    'partido_nombre'=> $item->first()['partido'],
                    'partido_logo'=> $item->first()['logotipo'],
                    'candidato_departamento_id'=> $candidato_departamento_id,
                    'candidato_departamento_nombre'=> $candidato_departamento_nombre,
                    'candidato_departamento_foto'=> $candidato_departamento_foto,
                    'candidato_provincia_id'=> $candidato_provincia_id,
                    'candidato_provincia_nombre'=> $candidato_provincia_nombre,
                    'candidato_provincia_foto'=> $candidato_provincia_foto,
                    'candidato_distrito_id'=> $candidato_distrito_id,
                    'candidato_distrito_nombre'=> $candidato_distrito_nombre,
                    'candidato_distrito_foto'=> $candidato_distrito_foto,
                ];
            })
            ->values()
        ;
        return response()->json($candidatos, 200, []);
    }
}
