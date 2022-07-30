<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Funcion;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class FuncionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //obtener todos los registros de la tabla funciones
        try {
            $funciones = Funcion::all();
            return response()->json(["funciones" => $funciones, "success" => true], 200);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage(), "success" => false], 500);
        }
    }
    public function pagination(Request $request)
    {
        $funciones = Funcion::select(["*"]);
        return DataTables::of($funciones)->make(true);
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
        //crear funcion
        try {
            $funcion = new Funcion();
            $funcion->nombre = $request->nombre;
            $funcion->estado = "activo";
            $funcion->save();
            return response()->json(["funcion" => $funcion, "success" => true, "message" => "Funcion creada correctamente"], 200);
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
        //detalle de funcion
        try {
            $funcion = Funcion::find($id);
            return response()->json(["funcion" => $funcion, "success" => true], 200);
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
        //actualizar funcion
        try {
            $funcion = Funcion::find($id);
            $funcion->nombre = $request->nombre;
            $funcion->save();
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
        //eliminar funcion
        try {
            $funcion = Funcion::find($id);
            $funcion->delete();
            return response()->json(["message" => "Funcion eliminada correctamente", "success" => true], 200);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage(), "success" => false], 500);
        }
    }
}
