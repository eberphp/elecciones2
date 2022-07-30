<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EstadoGestion;
use App\Models\Evaluacion;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class EvaluacionController extends Controller
{
    public function index()
    {
        try{
            $evaluaciones = Evaluacion::all();
            return response()->json(["evaluaciones" => $evaluaciones, "success" => true], 200);
        }catch(Exception $e){
            return response()->json(['message' => $e->getMessage(),"success"=>false], 500);
        }
    }

    public function pagination(Request $request)
    {
        $areas = EstadoGestion::select(["*"]);
        return DataTables::of($areas)->make(true);
    }

    public function create()
    {
       
    }

   
    public function store(Request $request)
    {
        try{
            $evaluacion= new Evaluacion();
            $evaluacion->titulo = $request->titulo;
            $evaluacion->descripcion = $request->descripcion;
            $evaluacion->usuario_id = 1;
            $evaluacion->save();
            return response()->json(["evaluacion" => $evaluacion, "success" => true,"message" => "Evaluacion creada correctamente"], 200);
        }catch(Exception $e){  
            return response()->json(['message' => $e->getMessage(),"success"=>false], 500);
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
            $evaluacion = Evaluacion::find($id);
            return response()->json(["evaluacion" => $evaluacion, "success" => true], 200);
        }catch(Exception $e){
            return response()->json(['message' => $e->getMessage(),"success"=>false], 500);
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
        //actualizar evaluacion
        try {
            $evaluacion=Evaluacion::find($id);
            $evaluacion->titulo = $request->titulo;
            $evaluacion->descripcion = $request->descripcion;
            $evaluacion->save();
            return response()->json(["evaluacion" => $evaluacion, "success" => true,"message" => "Evaluacion actualizada correctamente"], 200);
        }catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(),"success"=>false], 500);
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
        //eliminar evaluacion
        try {
            $evaluacion=Evaluacion::find($id);
            $evaluacion->delete();
            return response()->json(["success" => true,"message" => "Evaluacion eliminada correctamente"], 200);
        }catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(),"success"=>false], 500);
        }
    }
}
