<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Prioridad;
use Exception;
use Illuminate\Http\Request;
use LDAP\Result;
use Yajra\DataTables\DataTables;

class PrioridadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //todas las prioridades
        try {
            $prioridades = Prioridad::all();
            return response()->json(["prioridades" => $prioridades, "success" => true], 200);
        } catch (\Exception $e) {
            return response()->json(["message" => $e->getMessage(), "success" => false], 500);
        }
    }
    public function pagination(Request $request)
    {
        $areas = Prioridad::select(["*"]);
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
        //crear prioridad
        try {
            $prioridad = new Prioridad();
            $prioridad->nombre = $request->nombre;
            $prioridad->color= $request->color;
            $prioridad->estado = "activo";
            $prioridad->save();
            return response()->json(["prioridad" => $prioridad, "success" => true, "message" => "Prioridad creada correctamente"], 200);    
        } catch (\Exception $e) {
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
        //detalle prioridad
        try {
            $prioridad = Prioridad::find($id);
            return response()->json(["prioridad" => $prioridad, "success" => true], 200);
        } catch (\Exception $e) {
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
        //actualizar prioridad
        try {
            $prioridad = Prioridad::find($id);
            $prioridad->nombre = $request->nombre;
            $prioridad->color = $request->color;
            $prioridad->save();
            return response()->json(["prioridad" => $prioridad, "success" => true, "message" => "Prioridad actualizada correctamente"], 200);
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
        //
        try {
            $prioridad = Prioridad::find($id);
            $prioridad->delete();
            return response()->json(["prioridad" => $prioridad, "success" => true, "message" => "Prioridad eliminada correctamente"], 200);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage(), "success" => false], 500);
        }
    }
}
