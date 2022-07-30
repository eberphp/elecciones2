<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use App\Models\Departamento;
use Illuminate\Http\Request;
use App\Models\Partido;

class PartidosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $partidos = Partido::where('estado','activo')->get();
        $departamentos = Departamento::where('estado', 'activo')->get();
        return view('intranet.pages.empresa.encuestas.partidos')->with(compact('partidos', 'departamentos'));
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
        
        if($request->hasFile("logotipo")){

            $imagen = $request->file("logotipo");
            $nombreimagenLogotipo = $imagen->getClientOriginalName().".".$imagen->guessExtension();
            $ruta = public_path("img/logotipos/");
            
            $imagen->move($ruta,$nombreimagenLogotipo);
            //copy($imagen->getRealPath(),$ruta.$nombreimagen);

            //$post->imagen = $nombreimagen;            
            
        }
        //dd($request);
        $partido = new Partido();
        $partido->partido = $request->partido;
        $partido->idDepartamento = $request->idDepartamento;
        $partido->logotipo = $nombreimagenLogotipo;
        $partido->estado = 'activo';
        $partido->observacion = $request->observacion;
        $partido->save();
        /*Partido::create([
            'partido' => $request->partido,
            'idDepartamento' => $request->idDepartamento,
            'logotipo' => $nombreimagenLogotipo,
            'observacion' => $request->observacion,
            'estado' => 'activo',
        ]);*/
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
        $partido = Partido::find($id);
        if($request->hasFile("logotipo")){

            $imagen = $request->file("logotipo");
            $nombreimagenLogotipo = $imagen->getClientOriginalName().".".$imagen->guessExtension();
            $ruta = public_path("img/logotipos/");
            
            $imagen->move($ruta,$nombreimagenLogotipo);
            //copy($imagen->getRealPath(),$ruta.$nombreimagen);

            //$post->imagen = $nombreimagen;            
            
        }else{
            $nombreimagenLogotipo = $partido->logotipo;
        }
        $partido->partido = $request->partido;
        $partido->idDepartamento = $request->idDepartamento;
        $partido->logotipo = $nombreimagenLogotipo;
        $partido->observacion = $request->observacion;
        $partido->save();

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
        $partido = Partido::find($id);
        if ($partido->estado == 'activo') {
            $partido->estado = 'inactivo';
        } else {
            $partido->estado = 'activo';
        }
        $partido->save();
        return back();
        
    }
}
