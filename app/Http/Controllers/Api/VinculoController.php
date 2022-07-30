<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\vinculo;
use Exception;
use Illuminate\Http\Request;
use PhpParser\Node\Expr;
use Yajra\DataTables\DataTables;

class VinculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $vinculos = vinculo::all();
            return response()->json(["vinculos" => $vinculos, "success" => true], 200);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage(), "success" => false], 500);
        }
    }
    
    public function pagination(Request $request)
    {
        $vinculos = vinculo::select(["*"]);
        return DataTables::of($vinculos)->make(true);
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
        //crear vinculo
        try {
            $vinculo = new vinculo();
            $vinculo->nombre = $request->nombre;
            $vinculo->estado = "activo";
            $vinculo->save();
            return response()->json(["vinculo" => $vinculo, "success" => true, "message" => "Vinculo creado correctamente"], 200);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage(), "success" => false], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //detalle vinculo
        try {
            $vinculo = vinculo::find($id);
            return response()->json(["vinculo" => $vinculo, "success" => true], 200);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage(), "success" => false], 500);
        }
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
        //actualizar vinculo
        try {
            $vinculo = Vinculo::find($id);
            $vinculo->nombre = $request->nombre;
            $vinculo->save();
            return response()->json(["vinculo" => $vinculo, "success" => true, "message" => "Vinculo actualizado correctamente"], 200);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage(), "success" => false], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //eliminar vinculo
        try {
            $vinculo = Vinculo::find($id);
            $vinculo->delete();
            return response()->json(["message" => "Vinculo eliminado correctamente", "success" => true], 200);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage(), "success" => false], 500);
        }
    }
}
