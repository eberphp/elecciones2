<?php

namespace App\Http\Controllers\Empresa;


use App\Models\Votos;
use App\Models\Partido;
use App\Models\Candidato;
use App\Models\Encuestas;
use App\Models\Departamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class EleccionesVotosController extends Controller
{
    public function index(Request $request)
    {

        $votos = Votos::with('encuesta:idEncuesta,nombreEncuesta,fechaTermino')->with('partido:id,partido,logotipo,observacion')
            ->with('departamento:id,departamento')
            ->select('idVoto', 'encuestaId', 'partidoId', 'departamentoId', 'region', DB::raw('IFNULL(SUM(votos),0) as votos'), 'tipoEncuesta', 'fecha', 'estado')->where('datos_empresa_id', idEmpresa())
            ->groupBy('encuestaId', 'partidoId', 'region')->get();

        return view('intranet.pages.empresa.elecciones.votos_encuesta', [
            'votos' => $votos
        ]);
    }

    public function store(Request $request)
    {
        $valiData = $request->validate([
            'encuesta' => 'required',
            'departamento' => 'required',
            'provincia' => 'required',
            'distrito' => 'required',
            'zona' => 'required',

            'partidoRegional' => 'required',
            'votoRegional' => 'required',

            'partidoProvincial' => 'required',
            'votoProvincial' => 'required',

            'partidoDistrital' => 'required',
            'votoDistrital' => 'required',


        ]);


        $votoRegional = Votos::create([
            'encuestaId' => $valiData['encuesta'],
            'partidoId' => $valiData['partidoRegional'],
            'departamentoId' => $valiData['departamento'],
            'datos_empresa_id'  => idEmpresa(),
            'zonaId' => $valiData['zona'],
            'region' => 'Regional',
            'votos' => 1,
            'tipoEncuesta' => 'Encuesta',
            'codigo' => 'ENC-00' . Auth::user()->id,
            'fecha' => date('Y-m-d'),
        ]);

        $votoProvincial = Votos::create([
            'encuestaId' => $valiData['encuesta'],
            'datos_empresa_id'  => idEmpresa(),
            'partidoId' => $valiData['partidoProvincial'],
            'departamentoId' => $valiData['departamento'],
            'provinciaId' => $valiData['provincia'],
            'zonaId' => $valiData['zona'],
            'region' => 'Provincial',
            'votos' => 1,
            'tipoEncuesta' => 'Encuesta',
            'codigo' => 'ENC-00' . Auth::user()->id,
            'fecha' => date('Y-m-d'),
        ]);

        $votoDistrital = Votos::create([
            'encuestaId' => $valiData['encuesta'],
            'partidoId' => $valiData['partidoDistrital'],
            'departamentoId' => $valiData['departamento'],
            'provinciaId' => $valiData['provincia'],
            'distritoId' => $valiData['distrito'],
            'datos_empresa_id'  => idEmpresa(),
            'zonaId' => $valiData['zona'],
            'region' => 'Distrital',
            'votos' => 1,
            'tipoEncuesta' => 'Encuesta',
            'codigo' => 'ENC-00' . Auth::user()->id,
            'fecha' => date('Y-m-d'),
        ]);

        if ($votoRegional && $votoProvincial && $votoDistrital) {
            return response()->json([
                'status' => true,
                'message' => 'Votos registrados Correctamente',
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Sucedio algo al registrar los votos',
            ], 200);
        }
    }

    public function storeDispositivo(Request $request)
    {
        $valiData = $request->validate([
            'encuesta' => 'required',
            'departamento' => 'required',
            'provincia' => 'required',
            'distrito' => 'required',
            'zona' => 'required',

            'partidoRegional' => 'required',
            'votoRegional' => 'required',

            'partidoProvincial' => 'required',
            'votoProvincial' => 'required',

            'partidoDistrital' => 'required',
            'votoDistrital' => 'required',


        ]);


        $votoRegional = Votos::create([
            'encuestaId' => $valiData['encuesta'],
            'partidoId' => $valiData['partidoRegional'],
            'departamentoId' => $valiData['departamento'],
            'zonaId' => $valiData['zona'],
            'region' => 'Regional',
            'votos' => 1,
            'datos_empresa_id'  => idEmpresa(),
            'tipoEncuesta' => 'Dispositivo',
            'codigo' => 'VT-DISP',
            'fecha' => date('Y-m-d'),
        ]);

        $votoProvincial = Votos::create([
            'encuestaId' => $valiData['encuesta'],
            'partidoId' => $valiData['partidoProvincial'],
            'departamentoId' => $valiData['departamento'],
            'provinciaId' => $valiData['provincia'],
            'zonaId' => $valiData['zona'],
            'region' => 'Provincial',
            'votos' => 1,
            'datos_empresa_id'  => idEmpresa(),
            'tipoEncuesta' => 'Dispositivo',
            'codigo' => 'VT-DISP',
            'fecha' => date('Y-m-d'),
        ]);

        $votoDistrital = Votos::create([
            'encuestaId' => $valiData['encuesta'],
            'partidoId' => $valiData['partidoDistrital'],
            'departamentoId' => $valiData['departamento'],
            'provinciaId' => $valiData['provincia'],
            'distritoId' => $valiData['distrito'],
            'zonaId' => $valiData['zona'],
            'region' => 'Distrital',
            'votos' => 1,
            'tipoEncuesta' => 'Dispositivo',
            'codigo' => 'VT-DISP',
            'fecha' => date('Y-m-d'),
        ]);

        if ($votoRegional && $votoProvincial && $votoDistrital) {
            return response()->json([
                'status' => true,
                'message' => 'Votos registrados Correctamente',
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Sucedio algo al registrar los votos',
            ], 200);
        }
    }



    public function storeManual(Request $request)
    {


        $valiData = $request->validate([
            'encuesta' => 'required',
            'codigo' => 'required|string',
            'departamento' => 'required',
            'provincia' => 'required',
            'distrito' => 'required',
            'zona' => 'required',

            'votoReg' => 'required|array',

            'votoPro' => 'required|array',

            'votoDis' => 'required|array',


        ]);

        for ($i = 0; $i < count($valiData['votoReg']); $i++) {
            $votoRegional = Votos::create([
                'encuestaId' => $valiData['encuesta'],
                'partidoId' => $valiData['votoReg'][$i][0],
                'departamentoId' => $valiData['departamento'],
                'zonaId' => $valiData['zona'],
                'region' => 'Regional',
                'datos_empresa_id'  => idEmpresa(),
                'votos' => $valiData['votoReg'][$i][1],
                'tipoEncuesta' => 'Manual',
                'codigo' => $valiData['codigo'],
                'fecha' => date('Y-m-d'),
            ]);
        }

        for ($i = 0; $i < count($valiData['votoPro']); $i++) {
            $votoProvincial = Votos::create([
                'encuestaId' => $valiData['encuesta'],
                'partidoId' => $valiData['votoPro'][$i][0],
                'departamentoId' => $valiData['departamento'],
                'provinciaId' => $valiData['provincia'],
                'zonaId' => $valiData['zona'],
                'datos_empresa_id'  => idEmpresa(),
                'region' => 'Provincial',
                'votos' => $valiData['votoPro'][$i][1],
                'tipoEncuesta' => 'Manual',
                'codigo' => $valiData['codigo'],
                'fecha' => date('Y-m-d'),
            ]);
        }

        for ($i = 0; $i < count($valiData['votoDis']); $i++) {
            $votoDistrital = Votos::create([
                'encuestaId' => $valiData['encuesta'],
                'partidoId' => $valiData['votoDis'][$i][0],
                'departamentoId' => $valiData['departamento'],
                'provinciaId' => $valiData['provincia'],
                'distritoId' => $valiData['distrito'],
                'datos_empresa_id'  => idEmpresa(),
                'zonaId' => $valiData['zona'],
                'region' => 'Distrital',
                'votos' => $valiData['votoDis'][$i][1],
                'tipoEncuesta' => 'Manual',
                'codigo' => $valiData['codigo'],
                'fecha' => date('Y-m-d'),
            ]);
        }

        if ($votoRegional && $votoProvincial && $votoDistrital) {
            return response()->json([
                'status' => true,
                'message' => 'Votos registrados Correctamente',
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Sucedio algo al registrar los votos',
            ], 200);
        }
    }

    public function getVotosDepartamentos(Request $request, $encuesta, $departamento, $provincia, $distrito, $zona)
    {
        $partidos = Partido::select('id', 'partido', 'logotipo')->where('idDepartamento', $departamento)->where('estado', 'activo')->get();

        $siEncuesta = Encuestas::where('idEncuesta', $encuesta)->first();

        $tVotos = [];


        ($siEncuesta->dispositivo == "Si") ? array_push($tVotos, 'Dispositivo') : '';
        ($siEncuesta->encuestador == "Si") ? array_push($tVotos, 'Encuesta') : '';
        ($siEncuesta->manual == "Si") ? array_push($tVotos, 'Manual')  : '';


        // dd($zona);
        $variacion = '=';
        if ($zona == '' || $zona == 'Todos') {
            $variacion = '>';
            $zona = 0;
        }

        foreach ($partidos as $partido) {
            $partido['Regional'] = Votos::select(DB::raw('IFNULL(SUM(votos),0) as total'))
                ->where(function ($query) use ($tVotos) {
                    $query->whereIn('tipoEncuesta', $tVotos);
                })
                ->where('departamentoId', $departamento)
                ->where('partidoId', $partido->id)->where('zonaId', $variacion, $zona)
                ->where('encuestaId', $siEncuesta->idEncuesta)
                ->where('estado', 'Activo')->where('region', 'Regional')->get();

            $partido['Provincial'] = Votos::select(DB::raw('IFNULL(SUM(votos),0) as total'))
                ->where(function ($query) use ($tVotos) {
                    $query->whereIn('tipoEncuesta', $tVotos);
                })
                ->where('departamentoId', $departamento)->where('provinciaId', $provincia)
                ->where('partidoId', $partido->id)->where('zonaId', $variacion, $zona)
                ->where('encuestaId', $siEncuesta->idEncuesta)
                ->where('estado', 'Activo')->where('region', 'Provincial')->get();

            $partido['Distrital'] = Votos::select(DB::raw('IFNULL(SUM(votos),0) as total'))
                ->where(function ($query) use ($tVotos) {
                    $query->whereIn('tipoEncuesta', $tVotos);
                })
                ->where('departamentoId', $departamento)->where('provinciaId', $provincia)->where('distritoId', $distrito)
                ->where('partidoId', $partido->id)->where('zonaId', $variacion, $zona)
                ->where('encuestaId', $siEncuesta->idEncuesta)
                ->where('estado', 'Activo')->where('region', 'Distrital')->get();

            // Candidatos Foto
            $partido['cReg'] = Candidato::select('foto', 'visualiza')->where('idDepartamento', $departamento)->where('tipo', 'Regional')
                ->where('idPartido', $partido->id)->where('estado', 'activo')->get();

            $partido['cPro'] = Candidato::select('foto', 'visualiza')->where('idDepartamento', $departamento)
                ->where('idProvincia', $provincia)->where('tipo', 'Provincial')
                ->where('idPartido', $partido->id)->where('estado', 'activo')->get();

            $partido['cDis'] = Candidato::select('foto', 'visualiza')->where('idDepartamento', $departamento)->where('idProvincia', $provincia)
                ->where('idDistrito', $distrito)->where('tipo', 'Distrital')
                ->where('idPartido', $partido->id)->where('estado', 'activo')->get();
        }

        return response()->json($partidos);
    }


    public function encuestador(Request $request, Encuestas $encuesta)
    {
        $departamentos = Departamento::where('estado', 'activo')->get();
        return view('intranet.pages.empresa.elecciones.voto_encuestador', [
            'encuesta' => $encuesta,
            'departamentos' => $departamentos,
        ]);
    }

    public function dispositivo(Request $request, $encuesta)
    {
        $id = Crypt::decryptString($encuesta);

        $encuesta = Encuestas::where('idEncuesta', $id)->first();

        $departamentos = Departamento::where('estado', 'activo')->get();
        return view('intranet.pages.empresa.elecciones.voto_dispositivo', [
            'encuesta' => $encuesta,
            'departamentos' => $departamentos,
        ]);
    }

    public function manual(Request $request, Encuestas $encuesta)
    {
        $departamentos = Departamento::where('estado', 'activo')->get();
        return view('intranet.pages.empresa.elecciones.voto_manual', [
            'encuesta' => $encuesta,
            'departamentos' => $departamentos,
        ]);
    }

    public function grafico(Request $request, Encuestas $encuesta)
    {
        $departamentos = Departamento::where('estado', 'activo')->get();
        $encuestas = Encuestas::where('estado', 'Activo')->orderBy('idEncuesta','desc')->get();;

        $porDispositivo = Votos::select(DB::raw('IFNULL(SUM(votos),0) as total'))
            ->where('tipoEncuesta', 'Dispositivo')->where('encuestaId', $encuesta->idEncuesta)->get();

        $porEncuestador = Votos::select(DB::raw('IFNULL(SUM(votos),0) as total'))
            ->where('tipoEncuesta', 'Encuesta')->where('encuestaId', $encuesta->idEncuesta)->get();

        $porManual = Votos::select(DB::raw('IFNULL(SUM(votos),0) as total'))
            ->where('tipoEncuesta', 'Manual')->where('encuestaId', $encuesta->idEncuesta)->get();

        return view('intranet.pages.empresa.elecciones.voto_graficos', [
            'encuesta' => $encuesta,
            'encuestas' => $encuestas,
            'porDispositivo' => $porDispositivo,
            'porEncuestador' => $porEncuestador,
            'porManual' => $porManual,
            'departamentos' => $departamentos,
        ]);
    }

    public function graficoPublico(Request $request,  $encuesta)
    {
        $id = Crypt::decryptString($encuesta);

        $encuesta = Encuestas::where('idEncuesta', $id)->where('datos_empresa_id', idEmpresa())->first();
        if(!$encuesta){
            abort(404);
        }

        $departamentos = Departamento::where('estado', 'activo')->get();
        $encuestas = Encuestas::where('estado', 'Activo')->where('datos_empresa_id', idEmpresa())->orderBy('idEncuesta','desc')->get();;

        $porDispositivo = Votos::select(DB::raw('IFNULL(SUM(votos),0) as total'))
            ->where('tipoEncuesta', 'Dispositivo')->where('encuestaId', $encuesta->idEncuesta)->get();

        $porEncuestador = Votos::select(DB::raw('IFNULL(SUM(votos),0) as total'))
            ->where('tipoEncuesta', 'Encuesta')->where('encuestaId', $encuesta->idEncuesta)->get();

        $porManual = Votos::select(DB::raw('IFNULL(SUM(votos),0) as total'))
            ->where('tipoEncuesta', 'Manual')->where('encuestaId', $encuesta->idEncuesta)->get();

        return view('intranet.pages.empresa.elecciones.voto_graficos_publico', [
            'encuesta' => $encuesta,
            'encuestas' => $encuestas,
            'porDispositivo' => $porDispositivo,
            'porEncuestador' => $porEncuestador,
            'porManual' => $porManual,
            'departamentos' => $departamentos,
        ]);
    }
}
