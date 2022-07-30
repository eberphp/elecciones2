<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Cargo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class CargoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $cargos = Cargo::all();
            return response()->json(["cargos" => $cargos, "success" => true], 200);
        } catch (\Exception $e) {
            return response()->json(["message" => $e->getMessage(), "success" => false], 500);
        }
    }
    public function pagination(Request $request)
    {
        $areas = DB::table("cargos")->select(["*"]);
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
        try {
            $cargo = new Cargo();
            $cargo->nombre = $request->nombre;
            $cargo->estado = "activo";
            $cargo->save();
            return response()->json(["cargo" => $cargo, "success" => true, "message" => "Cargo creado correctamente"], 200);
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
        try {
            $cargo = Cargo::find($id);
            return response()->json(["cargo" => $cargo, "success" => true], 200);
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
        try {
            $cargo = new Cargo();
            $cargo->nombre = $request->nombre;
            $cargo->save();
            return response()->json(["cargo" => $cargo, "success" => true, "message" => "Cargo actualizado correctamente"], 200);
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
            $cargo = Cargo::find($id);
            $cargo->delete();
            return response()->json(["message" => "Cargo eliminado correctamente", "success" => true], 200);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage(), "success" => false], 500);
        }
    }
}
