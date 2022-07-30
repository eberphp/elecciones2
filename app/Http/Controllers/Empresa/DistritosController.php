<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DistritosImport;
use Illuminate\Http\Request;
use App\Models\Departamento;
use App\Models\Provincia;
use App\Models\Distrito;

use function Symfony\Component\String\b;

class DistritosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departamentos = Departamento::where('estado', 'activo')->orderBy('departamento', 'ASC')->get();
        $provincias = Provincia::where('estado','activo')->orderBy('provincia', 'ASC')->get();
        $distritos = Distrito::where('estado','activo')->get();
        return view('intranet.pages.empresa.encuestas.distritos')->with(compact('departamentos','provincias', 'distritos'));
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
        Distrito::create([
            'idDepartamento' => $request->idDepartamento,
            'idProvincia' => $request->idProvincia,
            'distrito' => $request->distrito,
            'estado' => 'activo'
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
        $distrito = Distrito::find($id);

        if ($distrito->estado === 'activo') {
            $distrito->estado = 'inactivo';
        } else {
            $distrito->estado = 'activo';
        }
        $distrito->save();
        return back();
        
    }

    public function import(Request $request){

        //dd($request->hasFile('departamentos'));
        $import = new DistritosImport();
        Excel::import($import, request()->file('distritos'));
        return back();
    }

    public function getDistritos($id){
        $distritos = Distrito::where('idProvincia',$id)->where('estado','activo')->get();
        return response()->json($distritos);
    }
}
