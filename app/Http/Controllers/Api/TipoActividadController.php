<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\TipoActividad;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TipoActividadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //todos los registros de la tabla tipo actividad
        try{
            $tipoActividad=TipoActividad::all();
            return response()->json(["tiposActividad"=>$tipoActividad,"success"=>true],200);
        }catch(Exception $e){
            return response()->json(["message" => $e->getMessage(), "success" => false], 500);
        }
    }
    public function pagination(Request $request)
    {
        $areas = TipoActividad::select(["*"]);
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
        //crear tipo de actividad
        try{
            $tipoActividad=new TipoActividad();
            $tipoActividad->nombre=$request->nombre;
            $tipoActividad->color=$request->color;
            $tipoActividad->estado="activo";
            $tipoActividad->save();
            return response()->json(["tipoActividad"=>$tipoActividad,"success"=>true,"message"=>"Tipo de actividad creada correctamente"],200);
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
        //detalle tipo de actividad
        try{
            $tipoActividad=TipoActividad::find($id);
            return response()->json(["tipoActividad"=>$tipoActividad,"success"=>true],200);
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
        //actualizar tipo de actividad
        try{
            $tipoActividad=TipoActividad::find($id);
            $tipoActividad->nombre=$request->nombre;
            $tipoActividad->color=$request->color;
            $tipoActividad->save();
            return response()->json(["tipoActividad"=>$tipoActividad,"success"=>true,"message"=>"Tipo de actividad actualizada correctamente"],200);
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
        //
        try{
            $tipoActividad=TipoActividad::find($id);
            $tipoActividad->delete();
            return response()->json(["message"=>"Tipo de actividad eliminada correctamente","success"=>true],200);
        }catch(Exception $e){
            return response()->json(["message" => $e->getMessage(), "success" => false], 500);
        }
    }
}
