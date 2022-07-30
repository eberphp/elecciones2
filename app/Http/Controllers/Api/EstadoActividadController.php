<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\EstadoActividad;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr;
use Yajra\DataTables\DataTables;

class EstadoActividadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $estados = EstadoActividad::all();
            return response()->json(["estadosActividad" => $estados, "success" => true], 200);
        }catch(\Exception $e){
            return response()->json(["message" => $e->getMessage(), "success" => false], 500);
        }
    }
    public function pagination(Request $request)
    {
        $areas = EstadoActividad::select(["*"]);
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
            $estadoactividad=new EstadoActividad();
            $estadoactividad->nombre=$request->nombre;
            $estadoactividad->color=$request->color;
            $estadoactividad->estado="activo";
            $estadoactividad->save();
            return response()->json(["estadoActividad" => $estadoactividad, "success" => true, "message" => "Estado de actividad creado correctamente"], 200);
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
        //Detalle de Actividad
        try{
            $estadoactividad=EstadoActividad::find($id);
            return response()->json(["estadoActividad" => $estadoactividad, "success" => true], 200);
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
        //Actualizar estado de actividad
        try{
            $estadoactividad=EstadoActividad::find($id);
            $estadoactividad->nombre=$request->nombre;
            $estadoactividad->color=$request->color;
            $estadoactividad->save();
            return response()->json(["estadoActividad" => $estadoactividad, "success" => true, "message" => "Estado de actividad actualizado correctamente"], 200);
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
        //Dar de baja estado de actividad
        try{
            $estadoactividad=EstadoActividad::find($id);
            $estadoactividad->delete();
            return response()->json(["estadoActividad" => $estadoactividad, "success" => true, "message" => "Estado de actividad dado de baja correctamente"], 200);
        }catch(Exception $e){
            return response()->json(["message" => $e->getMessage(), "success" => false], 500);
        }
    }
}
