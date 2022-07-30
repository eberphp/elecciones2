<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TipoUbigeo;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TipoUbigeoController extends Controller
{
    public function index()
    {
        //todos los estados de gestion
        try {
            $tiposUbigeo = TipoUbigeo::all();
            return response()->json(["tiposUbigeo" => $tiposUbigeo, "success" => true], 200);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage(), "success" => false], 500);
        }
    }
    public function pagination(Request $request)
    {
        $areas = TipoUbigeo::select(["*"]);
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
            $tipoUbigeo = new TipoUbigeo();
            $tipoUbigeo->nombre = $request->nombre;
           
            $tipoUbigeo->save();
            return response()->json(["tipoUbigeo" => $tipoUbigeo, "success" => true, "message" => "Estado de gestión creado correctamente"], 200);
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
            $tipoUbigeo = TipoUbigeo::find($id);
            return response()->json(["tipoUbigeo" => $tipoUbigeo, "success" => true], 200);
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
            $tipoUbigeo = TipoUbigeo::find($id);
            $tipoUbigeo->nombre = $request->nombre;
            $tipoUbigeo->save();
            return response()->json(["tipoUbigeo" => $tipoUbigeo, "success" => true, "message" => "Estado de gestión actualizado correctamente"], 200);
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
            $tipoUbigeo = TipoUbigeo::find($id);
            $tipoUbigeo->delete();
            return response()->json(["tipoUbigeo" => $tipoUbigeo, "success" => true, "message" => "Estado de gestión eliminado correctamente"], 200);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage(), "success" => false], 500);
        }
    }
}
