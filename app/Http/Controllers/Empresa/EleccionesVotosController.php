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
use App\Models\Eleccion;
use App\Models\EleccionesVoto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\DataTables;

class EleccionesVotosController extends Controller
{
    public function index(Request $request)
    {

        $votos = EleccionesVoto::with('eleccion:id,nombre,fecha_termino')->with('partido:id,partido,logotipo,observacion')
            ->with('_departamento:id,departamento')
            ->select('id', 'eleccion_id', 'partido_id', 'departamento', 'region', DB::raw('IFNULL(SUM(votos),0) as votos'), 'tipo_voto', 'fecha', 'estado')->where('datos_empresa_id', idEmpresa())
            ->groupBy('eleccion_id', 'partido_id', 'region')->get();
        return view('intranet.pages.empresa.elecciones.votos_encuesta', [
            'votos' => $votos
        ]);
    }
    public function indexWeb(Request $request)
    {

        $votos = EleccionesVoto::with('eleccion:id,nombre,fecha_termino')->with('partido:id,partido,logotipo,observacion')
            ->with('_departamento:id,departamento')
            ->select('id', 'eleccion_id', 'partido_id', 'departamento', 'region', DB::raw('IFNULL(SUM(votos),0) as votos'), 'tipo_voto', 'fecha', 'estado')->where('datos_empresa_id', idEmpresa())
            ->groupBy('eleccion_id', 'partido_id', 'region')->get();
        return view('intranet.pages.empresa.elecciones.votos_encuesta', [
            'votos' => $votos
        ]);
    }
    public function pagination()
    {
        $votos = EleccionesVoto::with('eleccion:id,nombre,fecha_termino')->with('partido', '_departamento', '_provincia', '_distrito', "locales_votacion", "creador", "editor")
            ->select(
                'elecciones_votos.id',
                'elecciones_votos.eleccion_id',
                "elecciones_votos.mesa_id",
                'elecciones_votos.partido_id',
                'elecciones_votos.departamento',
                "elecciones_votos.provincia",
                "elecciones_votos.distrito",
                'elecciones_votos.region',
                DB::raw('IFNULL(SUM(votos),0) as votos'),
                DB::raw('IFNULL(SUM(elecciones_votos.votos_departamento),0) as votos_departamento'),
                DB::raw('IFNULL(SUM(elecciones_votos.votos_provincia),0) as votos_provincia'),
                DB::raw('IFNULL(SUM(elecciones_votos.votos_distrito),0) as votos_distrito'),
                'elecciones_votos.tipo_voto',
                'elecciones_votos.fecha',
                'elecciones_votos.estado',
                "elecciones_votos.created_by",
                "elecciones_votos.updated_by"
            )->where('elecciones_votos.datos_empresa_id', idEmpresa())
            ->groupBy('elecciones_votos.departamento', 'elecciones_votos.provincia', 'elecciones_votos.distrito', "elecciones_votos.mesa_id");
        return DataTables::of($votos)->make(true);
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


        $votoRegional = EleccionesVoto::create([
            'eleccion_id' => $valiData['encuesta'],
            'partido_id' => $valiData['partidoRegional'],
            'departamentoId' => $valiData['departamento'],
            'datos_empresa_id'  => idEmpresa(),
            'zonaId' => $valiData['zona'],
            'region' => 'Regional',
            'votos' => 1,
            'tipo_voto' => 'Encuesta',
            'codigo' => 'ENC-00' . Auth::user()->id,
            'fecha' => date('Y-m-d'),
        ]);

        $votoProvincial = EleccionesVoto::create([
            'eleccion_id' => $valiData['encuesta'],
            'datos_empresa_id'  => idEmpresa(),
            'partido_id' => $valiData['partidoProvincial'],
            'departamentoId' => $valiData['departamento'],
            'provinciaId' => $valiData['provincia'],
            'zonaId' => $valiData['zona'],
            'region' => 'Provincial',
            'votos' => 1,
            'tipo_voto' => 'Encuesta',
            'codigo' => 'ENC-00' . Auth::user()->id,
            'fecha' => date('Y-m-d'),
        ]);

        $votoDistrital = EleccionesVoto::create([
            'eleccion_id' => $valiData['encuesta'],
            'partido_id' => $valiData['partidoDistrital'],
            'departamentoId' => $valiData['departamento'],
            'provinciaId' => $valiData['provincia'],
            'distrito' => $valiData['distrito'],
            'datos_empresa_id'  => idEmpresa(),
            'zonaId' => $valiData['zona'],
            'region' => 'Distrital',
            'votos' => 1,
            'tipo_voto' => 'Encuesta',
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

    public function storeManual(Request $request)
    {
        try {
            $usuario_action = $request->user();
            $valiData = $request->validate([
                'eleccion' => 'required',
                'codigo' => 'required|string',
                'departamento' => 'required',
                'provincia' => 'required',
                'distrito' => 'required',
                'votoReg' => 'required|array',
                'votoPro' => 'required|array',
                'votoDis' => 'required|array',
                "votos" => "required|array",
                "num_mesa" => "required",
                "editar" => "required"
            ]);

            if ($valiData && $valiData["editar"]) {
                $votosguardados = true;
                for ($i = 0; $i < count($valiData['votos']); $i++) {
                    $votoexiste = EleccionesVoto::where("eleccion_id", $valiData["eleccion"])
                        ->where("partido_id", $valiData['votos'][$i]["partido_id"])
                        ->where("mesa_id", $request->num_mesa)->first();
                    $votoexiste->votos_departamento = isset($valiData["votos"][$i]["votos_departamento"])?$valiData["votos"][$i]["votos_departamento"]:0;
                    $votoexiste->votos_provincia = isset($valiData["votos"][$i]["votos_provincia"])?$valiData["votos"][$i]["votos_provincia"]:0;
                    $votoexiste->votos_distrito = isset($valiData["votos"][$i]["votos_distrito"])?$valiData["votos"][$i]["votos_distrito"]:0;
                    $votoexiste->votos = isset($valiData['votos'][$i]['totalvotos'])?$valiData['votos'][$i]['totalvotos']:0;
                    $votoexiste->updated_by = $usuario_action->id;
                    $votoexiste->save();
                }
            } else if ($valiData && !$valiData['editar']) {
                for ($i = 0; $i < count($valiData['votos']); $i++) {
                    $votosguardados = EleccionesVoto::create([
                        'eleccion_id' => $valiData['eleccion'],
                        'partido_id' => $valiData['votos'][$i]["partido_id"],
                        'departamento' => $valiData['departamento'],
                        'provincia' => $valiData['provincia'],
                        'distrito' => $valiData['distrito'],
                        'datos_empresa_id'  => idEmpresa(),
                        'mesa_id' => $request->num_mesa,
                        'region' => 'Distrital',
                        'votos' => isset($valiData['votos'][$i]['totalvotos'])?$valiData['votos'][$i]['totalvotos']:0,
                        'tipo_voto' => 'Manual',
                        'codigo' => $valiData['codigo'],
                        "votos_departamento" => isset($valiData["votos"][$i]["votos_departamento"])?$valiData["votos"][$i]["votos_departamento"]:0,
                        "votos_provincia" => isset($valiData["votos"][$i]["votos_provincia"])?$valiData["votos"][$i]["votos_provincia"]:0,
                        "votos_distrito" => isset($valiData["votos"][$i]["votos_distrito"])?$valiData["votos"][$i]["votos_distrito"]:0,
                        "created_by" => $usuario_action->id,
                        "updated_by" => $usuario_action->id,
                        'fecha' => date('Y-m-d'),
                    ]);
                }
            }

            if ($votosguardados) {
                return response()->json([
                    'status' => true,
                    'message' => 'Votos registrados Correctamente',
                    'usuario' => $usuario_action
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Sucedio algo al registrar los votos',
                    'usuario' => $usuario_action
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
    public function storeManualWeb(Request $request)
    {
        try {
            $usuario_action = $request->user("personal");
            $valiData = $request->validate([
                'eleccion' => 'required',
                'codigo' => 'required|string',
                'departamento' => 'required',
                'provincia' => 'required',
                'distrito' => 'required',
                'votoReg' => 'required|array',
                'votoPro' => 'required|array',
                'votoDis' => 'required|array',
                "votos" => "required|array",
                "num_mesa" => "required",
                "editar" => "required"
            ]);

            if ($valiData && $valiData["editar"]) {
                $votosguardados = true;
                for ($i = 0; $i < count($valiData['votos']); $i++) {
                    $votoexiste = EleccionesVoto::where("eleccion_id", $valiData["eleccion"])
                        ->where("partido_id", $valiData['votos'][$i]["partido_id"])
                        ->where("mesa_id", $request->num_mesa)->first();/* 
                    $votoexiste->votos_departamento = $valiData["votos"][$i]["votos_departamento"];
                    $votoexiste->votos_provincia = $valiData["votos"][$i]["votos_provincia"];
                    $votoexiste->votos_distrito = $valiData["votos"][$i]["votos_distrito"];
                    $votoexiste->votos = $valiData['votos'][$i]['totalvotos']; */
                    $votoexiste->votos_departamento = isset($valiData["votos"][$i]["votos_departamento"])?$valiData["votos"][$i]["votos_departamento"]:0;
                    $votoexiste->votos_provincia = isset($valiData["votos"][$i]["votos_provincia"])?$valiData["votos"][$i]["votos_provincia"]:0;
                    $votoexiste->votos_distrito = isset($valiData["votos"][$i]["votos_distrito"])?$valiData["votos"][$i]["votos_distrito"]:0;
                    $votoexiste->votos = isset($valiData['votos'][$i]['totalvotos'])?$valiData['votos'][$i]['totalvotos']:0;
                    $votoexiste->updated_by = $usuario_action->id;
                    $votoexiste->save();
                }
            } else if ($valiData && !$valiData['editar']) {
                for ($i = 0; $i < count($valiData['votos']); $i++) {
                    $votosguardados = EleccionesVoto::create([
                        'eleccion_id' => $valiData['eleccion'],
                        'partido_id' => $valiData['votos'][$i]["partido_id"],
                        'departamento' => $valiData['departamento'],
                        'provincia' => $valiData['provincia'],
                        'distrito' => $valiData['distrito'],
                        'datos_empresa_id'  => idEmpresa(),
                        'mesa_id' => $request->num_mesa,
                        'region' => 'Distrital',/* 
                        'votos' => $valiData['votos'][$i]['totalvotos'], */
                        'votos' => isset($valiData['votos'][$i]['totalvotos'])?$valiData['votos'][$i]['totalvotos']:0,
                        'tipo_voto' => 'Manual',
                        'codigo' => $valiData['codigo'],/* 
                        "votos_departamento" => $valiData["votos"][$i]["votos_departamento"],
                        "votos_provincia" => $valiData["votos"][$i]["votos_provincia"],
                        "votos_distrito" => $valiData["votos"][$i]["votos_distrito"], */
                        "votos_departamento" => isset($valiData["votos"][$i]["votos_departamento"])?$valiData["votos"][$i]["votos_departamento"]:0,
                        "votos_provincia" => isset($valiData["votos"][$i]["votos_provincia"])?$valiData["votos"][$i]["votos_provincia"]:0,
                        "votos_distrito" => isset($valiData["votos"][$i]["votos_distrito"])?$valiData["votos"][$i]["votos_distrito"]:0,
                       
                        "created_by" => $usuario_action->id,
                        "updated_by" => $usuario_action->id,
                        'fecha' => date('Y-m-d'),
                    ]);
                }
            }

            if ($votosguardados) {
                return response()->json([
                    'status' => true,
                    'message' => 'Votos registrados Correctamente',
                    'usuario' => $usuario_action
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Sucedio algo al registrar los votos',
                    'usuario' => $usuario_action
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
    public function getVotosDepartamentos(Request $request, $eleccion, $departamento, $provincia, $distrito, $zona)
    {
        $partidos = Partido::select('id', 'partido', 'logotipo')->where('idDepartamento', $departamento)->where('estado', 'activo')->get();
        $siEleccion = Eleccion::where('id', $eleccion)->first();
        $tVotos = [];
        ($siEleccion->dispositivo == "Si") ? array_push($tVotos, 'Dispositivo') : '';
        ($siEleccion->encuestador == "Si") ? array_push($tVotos, 'Encuesta') : '';
        ($siEleccion->manual == "Si") ? array_push($tVotos, 'Manual')  : '';
        // dd($zona);
        $variacion = '=';
        if ($zona == '' || $zona == 'Todos') {
            $variacion = '>';
            $zona = 0;
        }

        foreach ($partidos as $partido) {
            $partido['Regional'] = EleccionesVoto::select(DB::raw('IFNULL(SUM(votos_departamento),0) as total'))
                ->where('departamento', $departamento)
                ->where('partido_id', $partido->id)->where('mesa_id', $variacion, $zona)
                ->where('eleccion_id', $siEleccion->id)
                ->where('estado', 'Activo')->get();

            $partido['Provincial'] = EleccionesVoto::select(DB::raw('IFNULL(SUM(votos_provincia),0) as total'))
                ->where('departamento', $departamento)->where('provincia', $provincia)
                ->where('partido_id', $partido->id)->where('mesa_id', $variacion, $zona)
                ->where('eleccion_id', $siEleccion->id)
                ->where('estado', 'Activo')->get();

            $partido['Distrital'] = EleccionesVoto::select(DB::raw('IFNULL(SUM(votos_distrito),0) as total'))
                ->where('departamento', $departamento)->where('provincia', $provincia)->where('distrito', $distrito)
                ->where('partido_id', $partido->id)->where('mesa_id', $variacion, $zona)
                ->where('eleccion_id', $siEleccion->id)
                ->where('estado', 'Activo')->get();

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

        $encuesta = Eleccion::where('id', $id)->first();

        $departamentos = Departamento::where('estado', 'activo')->get();
        return view('intranet.pages.empresa.elecciones.voto_dispositivo', [
            'encuesta' => $encuesta,
            'departamentos' => $departamentos,
        ]);
    }

    public function manual(Request $request, Eleccion $eleccion)
    {
        $departamentos = Departamento::where('estado', 'activo')->get();
        return view('intranet.pages.empresa.elecciones.voto_manual', [
            'eleccion' => $eleccion,
            'departamentos' => $departamentos,
        ]);
    }
    public function manualWeb(Request $request, Eleccion $eleccion)
    {
        return view('web.pages.auth.votacion', [
            'eleccion' => $eleccion
        ]);
    }
    public function grafico(Request $request, Eleccion $eleccion)
    {
        $departamentos = Departamento::where('estado', 'activo')->get();
        $elecciones = Eleccion::where('estado', 'Activo')->orderBy('id', 'desc')->get();;

        $porDispositivo = EleccionesVoto::select(DB::raw('IFNULL(SUM(votos),0) as total'))
            ->where('tipo_voto', 'Dispositivo')->where('eleccion_id', $eleccion->id)->get();

        $porEncuestador = EleccionesVoto::select(DB::raw('IFNULL(SUM(votos),0) as total'))
            ->where('tipo_voto', 'Encuesta')->where('eleccion_id', $eleccion->id)->get();

        $porManual = EleccionesVoto::select(DB::raw('IFNULL(SUM(votos),0) as total'))
            ->where('tipo_voto', 'Manual')->where('eleccion_id', $eleccion->id)->get();

        return view('intranet.pages.empresa.elecciones.voto_graficos', [
            'eleccion' => $eleccion,
            'elecciones' => $elecciones,
            'porDispositivo' => $porDispositivo,
            'porEncuestador' => $porEncuestador,
            'porManual' => $porManual,
            'departamentos' => $departamentos,
        ]);
    }

    public function graficoPublico(Request $request,  $eleccion)
    {
        $id = Crypt::decryptString($eleccion);

        $_eleccion = Eleccion::where('id', $id)->where('datos_empresa_id', idEmpresa())->first();
        if (!$_eleccion) {
            abort(404);
        }

        $departamentos = Departamento::where('estado', 'activo')->get();
        $_elecciones = Eleccion::where('estado', 'Activo')->where('datos_empresa_id', idEmpresa())->orderBy('id', 'desc')->get();;

        $porDispositivo = EleccionesVoto::select(DB::raw('IFNULL(SUM(votos),0) as total'))
            ->where('tipo_voto', 'Dispositivo')->where('eleccion_id', $_eleccion->id)->get();

        $porEncuestador = EleccionesVoto::select(DB::raw('IFNULL(SUM(votos),0) as total'))
            ->where('tipo_voto', 'Encuesta')->where('eleccion_id', $_eleccion->id)->get();

        $porManual = EleccionesVoto::select(DB::raw('IFNULL(SUM(votos),0) as total'))
            ->where('tipo_voto', 'Manual')->where('eleccion_id', $_eleccion->id)->get();
        return view('intranet.pages.empresa.elecciones.voto_graficos_publico', [
            'eleccion' => $_eleccion,
            'elecciones' => $_elecciones,
            'porDispositivo' => $porDispositivo,
            'porEncuestador' => $porEncuestador,
            'porManual' => $porManual,
            'departamentos' => $departamentos,
        ]);
    }
}
