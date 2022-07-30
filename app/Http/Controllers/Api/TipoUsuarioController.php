<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\TipoUsuario;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TipoUsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // todos los tipos de usuario
        try {
            $tiposUsuario = TipoUsuario::all();
            return response()->json(["tiposUsuario" => $tiposUsuario, "success" => true], 200);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage(), "success" => false], 500);
        }
    }
    public function pagination(Request $request)
    {
        $areas = TipoUsuario::select(["*"]);
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
        //crear tipo de usuario
        try{
            $tipoUsuario=new TipoUsuario();
            $tipoUsuario->nivel=$request->nivel;
            $tipoUsuario->estado="activo";
            $tipoUsuario->save();
            return response()->json(["tipoUsuario"=>$tipoUsuario,"success"=>true,"message"=>"Tipo de usuario creada correctamente"],200);
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
        //detalle de tipo de usuario
        try {
            $tipoUsuario = TipoUsuario::find($id);
            return response()->json(["tipoUsuario" => $tipoUsuario, "success" => true], 200);
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
        //actualizar tipo de usuario
        try{
            $tipoUsuario=TipoUsuario::find($id);
            $tipoUsuario->nivel=$request->nivel;
            $tipoUsuario->save();
            return response()->json(["tipoUsuario"=>$tipoUsuario,"success"=>true,"message"=>"Tipo de usuario actualizada correctamente"],200);
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
            $tipoUsuario=TipoUsuario::find($id);
            $tipoUsuario->delete();
            return response()->json(["tipoUsuario"=>$tipoUsuario,"success"=>true,"message"=>"Tipo de usuario eliminada correctamente"],200);
        }catch(Exception $e){
            return response()->json(["message" => $e->getMessage(), "success" => false], 500);
        }
    }
}
