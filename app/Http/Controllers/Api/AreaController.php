<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Area;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $areas = Area::all();
            return response()->json(["areas" => $areas, "success" => true], 200);
        } catch (\Exception $e) {
            return response()->json(["message" => $e->getMessage(), "success" => false], 500);
        }
    }

    public function pagination(Request $request)
    {
        $areas = DB::table("areas")->select(["*"]);
        return DataTables::of($areas)->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            $area = new Area();
            $area->nombre = $request->nombre;
            $area->color = $request->color;
            $area->estado = "activo";
            $area->save();
            return response()->json(["area" => $area, "success" => true, "message" => "Area creada correctamente"], 200);
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
            $area = Area::find($id);
            return response()->json(["area" => $area, "success" => true], 200);
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
            $area = Area::find($id);
            $area->nombre = $request->nombre;
            $area->color = $request->color;
            $area->save();
            return response()->json(["area" => $area, "success" => true, "message" => "Area actualizada correctamente"], 200);
        } catch (Exception $e) {
            return response()->json(["error" => $e->getMessage(), "success" => false], 500);
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
            $area = Area::find($id);
            $area->delete();
            return response()->json(["area" => $area, "success" => true, "message" => "Area eliminada correctamente"], 200);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage(), "success" => false], 500);
        }
    }
}
