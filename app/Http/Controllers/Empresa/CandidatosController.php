<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Departamento;
use App\Models\Provincia;
use App\Models\Distrito;
use App\Models\Candidato;
use App\Models\Partido;

class CandidatosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $candidatos = Candidato::where('estado',true)->get();
        $departamentos = Departamento::where('estado', 'activo')->orderBy('departamento', 'ASC')->get();
        $provincias = Provincia::where('estado','activo')->orderBy('provincia', 'ASC')->get();
        $distritos = Distrito::where('estado','activo')->get();
        $partidos = Partido::where('estado', 'Activo')->orderBy('partido', 'ASC')->get();
        return view('intranet.pages.empresa.encuestas.candidatos')->with(compact('departamentos','provincias', 'distritos', 'candidatos', 'partidos'));
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
        if($request->hasFile("foto")){

            $imagen = $request->file("foto");
            $nombreimagenFoto = $imagen->getClientOriginalName().".".$imagen->guessExtension();
            $ruta = public_path("img/fotos/");
            
            $imagen->move($ruta,$nombreimagenFoto);
            //copy($imagen->getRealPath(),$ruta.$nombreimagen);

            //$post->imagen = $nombreimagen;            
            
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

        if($request->hasFile("foto")){

            $imagen = $request->file("foto");
            $nombreimagenFoto = $imagen->getClientOriginalName().".".$imagen->guessExtension();
            $ruta = public_path("img/fotos/");
            
            $imagen->move($ruta,$nombreimagenFoto);
            //copy($imagen->getRealPath(),$ruta.$nombreimagen);

            //$post->imagen = $nombreimagen;            
            
        }else{
            $nombreimagenFoto = $candidato->foto;
        }
        
        $candidato->nombreCorto = $request->nombreCorto;
        $candidato->tipo = $request->tipo;
        $candidato->departamento_id = $request->departamento_id;
        $candidato->provincia_id = $request->provincia_id;
        $candidato->distrito_id = $request->distrito_id;
        $candidato->partido = $request->partido;
        $candidato->nombre_apellido = $request->nombre_apellido;
        $candidato->foto = $nombreimagenFoto;//$request->foto;
        $candidato->observador = $request->observador;
        $candidato->save();
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
        if ($candidato->estado == 'activo') {
            $candidato->estado = 'inactivo';
        } else {
            $candidato->estado = 'activo';
        }
        $candidato->save();
        return back();
    }

}
