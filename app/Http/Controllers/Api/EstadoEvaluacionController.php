<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EstadoEvaluacion;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class EstadoEvaluacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $estadosEvaluacion = EstadoEvaluacion::all();
            return response()->json(["estadosEvaluacion" => $estadosEvaluacion, "success" => true], 200);
        }catch(Exception $e){
            return response()->json(["message" => $e->getMessage(), "success" => false], 500);
        }
    }
    public function pagination(Request $request)
    {
        $areas = EstadoEvaluacion::select(["*"]);
        return DataTables::of($areas)->make(true);
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
        try{
            $estadosEvaluacion=new EstadoEvaluacion();
            $estadosEvaluacion->nombre=$request->nombre;
            $estadosEvaluacion->estado="activo";
            $estadosEvaluacion->save();
            return response()->json(["estadosEvaluacion" => $estadosEvaluacion, "success" => true, "message" => "Estado de evaluación creado correctamente"], 200);
        }catch(Exception $e){
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
        try{
            $estadosEvaluacion=EstadoEvaluacion::find($id);
            return response()->json(["estadosEvaluacion" => $estadosEvaluacion, "success" => true], 200);
        }catch(Exception $e){
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
        try{
            $estadosEvaluacion=EstadoEvaluacion::find($id);
            $estadosEvaluacion->nombre=$request->nombre;
            $estadosEvaluacion->save();
            return response()->json(["estadosEvaluacion" => $estadosEvaluacion, "success" => true, "message" => "Estado de evaluación actualizado correctamente"], 200);
        }catch(Exception $e){
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
        try{
            $estadosEvaluacion=EstadoEvaluacion::find($id);
            $estadosEvaluacion->delete();
            return response()->json(["estadosEvaluacion" => $estadosEvaluacion, "success" => true, "message" => "Estado de evaluación dado de baja correctamente"], 200);
        }catch(Exception $e){
            return response()->json(["message" => $e->getMessage(), "success" => false], 500);
        }
    }
}
