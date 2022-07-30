<?php

namespace App\Http\Controllers\Empresa;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DepatamentosImport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Departamento;

class DepartamentosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departamentos = Departamento::where('estado','activo')->get();
        return view('intranet.pages.empresa.encuestas.departamentos')->with(compact('departamentos'));
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
        Departamento::create([
            'departamento' => $request->departamento,
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
        $dpartamento = Departamento::find($id);
        
        if ($dpartamento->estado === 'activo') {
            $dpartamento->estado = 'inactivo';
        } else {
            $dpartamento->estado = 'activo';
        }
        $dpartamento->save();
        
        //$dpartamento->estado = !$dpartamento->estado;
        return back();
    }

    public function import(Request $request){

        //dd($request->hasFile('departamentos'));
        $import = new DepatamentosImport();
        Excel::import($import, request()->file('departamentos'));
        return back();
    }
}
