<?php

namespace App\Http\Controllers\Empresa;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProvinciasImport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Departamento;
use App\Models\Provincia;


class ProvinciasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departamentos = Departamento::where('estado', 'activo')->orderBy('departamento', 'ASC')->get();
        $provincias = Provincia::where('estado','activo')->get();
        return view('intranet.pages.empresa.encuestas.provincias')->with(compact('departamentos','provincias'));
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
        Provincia::create([
            'idDepartamento' => $request->idDepartamento,
            'provincia' => $request->provincia,
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
        $provincia = Provincia::find($id);
        if ($provincia->estado === 'activo') {
            $provincia->estado = 'inactivo';
        } else {
            $provincia->estado = 'activo';
        }
        $provincia->save();

        return back();
        
    }

    public function import(Request $request){

        //dd($request->hasFile('departamentos'));
        $import = new ProvinciasImport();
        Excel::import($import, request()->file('provincias'));
        return back();
    }

    public function getProvincias($id){
        $provincias = Provincia::where('idDepartamento',$id)->where('estado','activo')->get();
        return response()->json($provincias);
    }
}
