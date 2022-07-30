<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use App\Models\Departamento;
use App\Models\Distrito;
use App\Models\Provincia;
use Illuminate\Http\Request;
use App\Models\Zona;

class ZonasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departamentos = Departamento::where('estado','activo')->orderBy('departamento', 'ASC')->get();
        $provincias = Provincia::where('estado', 'activo')->orderBy('provincia', 'ASC')->get();
        $distritos = Distrito::where('estado', 'activo')->orderBy('distrito', 'ASC')->get();
        $zonas = Zona::where('estado','activo')->get();
        return view('intranet.pages.empresa.encuestas.zonas')->with(compact('departamentos', 'provincias', 'distritos', 'zonas'));
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
        Zona::create([
            'idDepartamento' => $request->idDepartamento,
            'idProvincia' => $request->idProvincia,
            'idDistrito' => $request->idDistrito,
            'zona' => $request->zona,
            'estado' => 'activo',
        ]);
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $zona = Zona::find($id);
        if ($zona->estado == 'activo') {
            $zona->estado = 'inactivo';
        } else {
            $zona->estado = 'activo';
        }
        $zona->save();
        return back();
        
    }
}
