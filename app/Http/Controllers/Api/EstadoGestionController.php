<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\EstadoGestion;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class EstadoGestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //todos los estados de gestion
        try {
            $estadosGestion = EstadoGestion::all();
            return response()->json(["estadosGestion" => $estadosGestion, "success" => true], 200);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage(), "success" => false], 500);
        }
    }
    public function pagination(Request $request)
    {
        $areas = EstadoGestion::select(["*"]);
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
        //crear estado de gestion
        try {
            $estadoGestion = new EstadoGestion();
            $estadoGestion->nombre = $request->nombre;
            $estadoGestion->estado = "activo";
            $estadoGestion->save();
            return response()->json(["estadoGestion" => $estadoGestion, "success" => true, "message" => "Estado de gestión creado correctamente"], 200);
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
        //detalle estado gestion
        try {
            $estadoGestion = EstadoGestion::find($id);
            return response()->json(["estadoGestion" => $estadoGestion, "success" => true], 200);
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
        //editar estado de gestion
        try {
            $estadoGestion = EstadoGestion::find($id);
            $estadoGestion->nombre = $request->nombre;
            $estadoGestion->save();
            return response()->json(["estadoGestion" => $estadoGestion, "success" => true, "message" => "Estado de gestión actualizado correctamente"], 200);
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
        try {
            $estadoGestion = EstadoGestion::find($id);
            $estadoGestion->delete();
            return response()->json(["estadoGestion" => $estadoGestion, "success" => true, "message" => "Estado de gestión eliminado correctamente"], 200);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage(), "success" => false], 500);
        }
    }
}
