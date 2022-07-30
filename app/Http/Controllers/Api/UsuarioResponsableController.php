<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\UsuarioResponsable;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UsuarioResponsableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $usuarios = UsuarioResponsable::all();
            return response()->json(["usuarios" => $usuarios, "success" => true], 200);
        }catch(\Exception $e){
            return response()->json(["message" => $e->getMessage(), "success" => false], 500);

        }
    }
    public function pagination(Request $request)
    {
        $areas = UsuarioResponsable::select(["*"]);
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
        //
        try{
            $usuarioResponsable=new UsuarioResponsable();
            $usuarioResponsable->nombre=$request->nombre;
            $usuarioResponsable->estado="activo";
            $usuarioResponsable->save();
            return response()->json(["usuarioResponsable" => $usuarioResponsable, "success" => true, "message" => "Usuario creado correctamente"], 200);
        }catch(Exception $e) {
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
        //detalle de usuario responsable
        try{
            $usuarioResponsable=UsuarioResponsable::find($id);
            return response()->json(["usuarioResponsable"=>$usuarioResponsable,"success"=>true],200);
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
        //actualizar usuario responsable
        try{
            $usuario=UsuarioResponsable::find($id);
            $usuario->nombre=$request->nombre;
            $usuario->save();
            return response()->json(["usuarioResponsable"=>$usuario,"success"=>true,"message"=>"Usuario actualizado correctamente"],200);
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
            $usuario=UsuarioResponsable::find($id);
            $usuario->delete();
            return response()->json(["usuarioResponsable"=>$usuario,"success"=>true,"message"=>"Usuario eliminado correctamente"],200);

        }catch(Exception $e){
            return response()->json(["message" => $e->getMessage(), "success" => false], 500);
        }
    }
}
