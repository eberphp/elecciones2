<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Departamento;
use App\Models\Provincia;
use App\Models\Distrito;
use App\Models\Candidato;
use App\Models\EleccionesVoto;
use App\Models\Partido;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CandidatosController extends Controller
{

    public function index(Request $request)
    {


        $candidatos = Candidato::with('departamento', 'provincia', 'distrito')->where('estado', true)->where('datos_empresa_id', idEmpresa());

        if (!empty($request->buscador)) {
            $candidatos = $candidatos->where('nombresApellidos', 'like', '%' . $request->buscador . '%')
                ->orWhere('nombreCorto', 'like', '%' . $request->buscador . '%')
                ->orWhere('id', 'like', '%' . $request->buscador . '%');
        }
        $candidatos = $candidatos->paginate(10)->withQueryString();

        $departamentos = Departamento::where('estado', 'activo')->orderBy('departamento', 'ASC')->get();
        $provincias = Provincia::where('estado', 'activo')->orderBy('provincia', 'ASC')->get();
        $distritos = Distrito::where('estado', 'activo')->get();
        $partidos = Partido::where('estado', 'Activo')->orderBy('partido', 'ASC')->get();
        return view('intranet.pages.empresa.encuestas.candidatos', compact('departamentos', 'provincias', 'distritos', 'candidatos', 'partidos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nombreimagenFoto="";
        if ($request->file("foto")) {
            $imagen = $request->file("foto");
            $nombreimagenFoto = Str::slug(random_int(100000,20000000) . microtime()) . "." . $imagen->guessExtension();
            $rutasave = "public/img/fotos";
            $path = Storage::putFileAs($rutasave, $imagen, $nombreimagenFoto);
        }

        if ($request->tipo === 'Regional') {
            Candidato::create([
                'tipo' => $request->tipo,
                'idDepartamento' => $request->idDepartamento,
                //'idProvincia' => $request->idProvincia,
                //'idDistrito' => $request->idDistrito,
                'nombreCorto' => $request->nombreCorto,
                'idPartido' => $request->idPartido,
                'nombresApellidos' => $request->nombresApellidos,
                'foto' => $nombreimagenFoto,
                'estado' => 'activo',
                'visualiza' => 'Si',
                'observaciones' => $request->observacion
            ]);
        } else {
            if ($request->tipo === 'Provincial') {
                Candidato::create([
                    'tipo' => $request->tipo,
                    'idDepartamento' => $request->idDepartamento,
                    'idProvincia' => $request->idProvincia,
                    //'idDistrito' => $request->idDistrito,
                    'nombreCorto' => $request->nombreCorto,
                    'idPartido' => $request->idPartido,
                    'nombresApellidos' => $request->nombresApellidos,
                    'foto' => $nombreimagenFoto,
                    'estado' => 'activo',
                    'visualiza' => 'Si',
                    'observaciones' => $request->observacion
                ]);
            } else {
                Candidato::create([
                    'tipo' => $request->tipo,
                    'idDepartamento' => $request->idDepartamento,
                    'idProvincia' => $request->idProvincia,
                    'idDistrito' => $request->idDistrito,
                    'nombreCorto' => $request->nombreCorto,
                    'idPartido' => $request->idPartido,
                    'nombresApellidos' => $request->nombresApellidos,
                    'foto' => $nombreimagenFoto,
                    'estado' => 'activo',
                    'visualiza' => 'Si',
                    'observaciones' => $request->observacion
                ]);
            }
        }

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $candidato = Candidato::find($id);
        if ($request->file("foto")) {
            $imagen = $request->file("foto");
            $nombreimagenFoto = Str::slug(random_int(100000,20000000) . microtime()) . "." . $imagen->guessExtension();
            $rutasave = "public/img/fotos";
            $path = Storage::putFileAs($rutasave, $imagen, $nombreimagenFoto);
            $candidato->foto = $nombreimagenFoto;
            //$post->imagen = $nombreimagen;

        } 

        $candidato->nombreCorto = $request->nombreCorto;
        $candidato->tipo = $request->tipo;
        $candidato->idDepartamento = $request->idDepartamento;
        //$candidato->idProvincia = $request->idProvincia;
        //$candidato->idDistrito = $request->idDistrito;
        $candidato->idPartido = $request->idPartido;
        $candidato->nombresApellidos = $request->nombresApellidos;
         //$request->foto;
        $candidato->observaciones = $request->observacion;
        $candidato->save();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $candidato = Candidato::find($id);

        if (!$candidato) {
            return response()->json([
                'status' => false,
                'message' => 'No puedes Eliminar este Candidato'
            ], 402);
        } else {
            if ($candidato) {

                $req = $candidato->update([
                    'estado' => 'inactivo',
                ]);

                if ($req) {
                    return response()->json([
                        'status' => true,
                        'message' => 'Candidato Eliminado'
                    ], 200);
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => 'Sucedio un error. Vuelva a intentarlo'
                    ], 402);
                }
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Sucedio un error. Vuelva a intentarlo'
                ], 402);
            }
        }
    }

    public function getCandidatos(Request $request, $departamento, $provincia, $distrito)
    {
        $partidos = Partido::select('id', 'partido', 'logotipo')->where('idDepartamento', $departamento)->where('estado', 'activo')->get();

        foreach ($partidos as $partido) {
            $partido['Regional'] = Candidato::where('idDepartamento', $departamento)->where('tipo', 'Regional')
                ->where('idPartido', $partido->id)->where('estado', 'activo')->get();

            $partido['Provincial'] = Candidato::where('idDepartamento', $departamento)
                ->where('idProvincia', $provincia)->where('tipo', 'Provincial')
                ->where('idPartido', $partido->id)->where('estado', 'activo')->get();

            $partido['Distrital'] = Candidato::where('idDepartamento', $departamento)->where('idProvincia', $provincia)
                ->where('idDistrito', $distrito)->where('tipo', 'Distrital')
                ->where('idPartido', $partido->id)->where('estado', 'activo')->get();
        }

        return response()->json($partidos);
    }

    public function getCandidatosElecciones(Request $request, $departamento, $provincia, $distrito, $local, $eleccion)
    {
        $partidos = Partido::select('id', 'partido', 'logotipo')->where('idDepartamento', $departamento)->where('estado', 'activo')->get();
        $data_existe = 0;
        foreach ($partidos as $partido) {
            $votosregistrados = EleccionesVoto::where("mesa_id", $local)->where("eleccion_id", $eleccion)->where("partido_id", $partido->id)->first();
            $partido['Regional'] = Candidato::where('idDepartamento', $departamento)->where('tipo', 'Regional')
                ->where('idPartido', $partido->id)->where('estado', 'activo')->get();
            if ($votosregistrados) {
                if (count($partido["Regional"])) {
                    $partido["Regional"][0]["votos_departamento"] = $votosregistrados->votos_departamento;
                }
                $data_existe = 1;
            } else {
                if (count($partido["Regional"])) {
                    $partido["Regional"][0]["votos_departamento"] = 0;
                }
            }
            $partido['Provincial'] = Candidato::where('idDepartamento', $departamento)
                ->where('idProvincia', $provincia)->where('tipo', 'Provincial')
                ->where('idPartido', $partido->id)->where('estado', 'activo')->get();
            if ($votosregistrados) {
                if (count($partido["Provincial"])) {
                    $partido["Provincial"][0]["votos_provincia"] = $votosregistrados->votos_provincia;
                }
                $data_existe = 1;
            } else {
                if (count($partido["Provincial"])) {
                    $partido["Provincial"][0]["votos_provincia"] = 0;
                }
            }
            $partido['Distrital'] = Candidato::where('idDepartamento', $departamento)->where('idProvincia', $provincia)
                ->where('idDistrito', $distrito)->where('tipo', 'Distrital')
                ->where('idPartido', $partido->id)->where('estado', 'activo')->get();
            if ($votosregistrados) {
                if (count($partido["Distrital"])) {
                    $partido["Distrital"][0]["votos_distrito"] = $votosregistrados->votos_distrito;
                }
                $data_existe = 1;
            } else {
                if (count($partido["Distrital"])) {
                    $partido["Distrital"][0]["votos_distrito"] = 0;
                }
            }
        }

        return response()->json(["partidos" => $partidos, "editar" => $data_existe]);
    }
    public function getCandidatosEleccionesWeb(Request $request, $numero_mesa, $eleccion)
    {
        $localvotacion = DB::table("locales_votacion")->where("num_mesa", intval($numero_mesa))->first();
        $departamentoo = Departamento::where("departamento", $localvotacion->departamento)->first();
        $provinciao = Provincia::where("provincia", $localvotacion->provincia)->where("idDepartamento", $departamentoo->id)->first();
        $distritoo = Distrito::where("distrito", $localvotacion->distrito)->where("idDepartamento", $departamentoo->id)->where("idProvincia", $provinciao->id)->first();
        $departamento = $departamentoo->id;
        $provincia = $provinciao->id;
        $distrito = $distritoo->id;
        $local = $localvotacion->id;
        $partidos = Partido::select('id', 'partido', 'logotipo')->where('idDepartamento', $departamento)->where('estado', 'activo')->get();
        $data_existe = 0;
        foreach ($partidos as $partido) {
            $votosregistrados = EleccionesVoto::where("mesa_id", $local)->where("eleccion_id", $eleccion)->where("partido_id", $partido->id)->first();
            $partido['Regional'] = Candidato::where('idDepartamento', $departamento)->where('tipo', 'Regional')
                ->where('idPartido', $partido->id)->where('estado', 'activo')->get();
            if ($votosregistrados) {
                if (count($partido["Regional"])) {
                    $partido["Regional"][0]["votos_departamento"] = $votosregistrados->votos_departamento;
                }
                $data_existe = 1;
            } else {
                if (count($partido["Regional"])) {
                    $partido["Regional"][0]["votos_departamento"] = 0;
                }
            }
            $partido['Provincial'] = Candidato::where('idDepartamento', $departamento)
                ->where('idProvincia', $provincia)->where('tipo', 'Provincial')
                ->where('idPartido', $partido->id)->where('estado', 'activo')->get();
            if ($votosregistrados) {
                if (count($partido["Provincial"])) {
                    $partido["Provincial"][0]["votos_provincia"] = $votosregistrados->votos_provincia;
                }
                $data_existe = 1;
            } else {
                if (count($partido["Provincial"])) {
                    $partido["Provincial"][0]["votos_provincia"] = 0;
                }
            }
            $partido['Distrital'] = Candidato::where('idDepartamento', $departamento)->where('idProvincia', $provincia)
                ->where('idDistrito', $distrito)->where('tipo', 'Distrital')
                ->where('idPartido', $partido->id)->where('estado', 'activo')->get();
            if ($votosregistrados) {
                if (count($partido["Distrital"])) {
                    $partido["Distrital"][0]["votos_distrito"] = $votosregistrados->votos_distrito;
                }
                $data_existe = 1;
            } else {
                if (count($partido["Distrital"])) {
                    $partido["Distrital"][0]["votos_distrito"] = 0;
                }
            }
        }
        return response()->json(["partidos" => $partidos, "editar" => $data_existe, "local" => $localvotacion, "departamento" => $departamento, "provincia" => $provincia, "distrito" => $distrito]);
    }
}
