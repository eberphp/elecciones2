<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Personal;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class PersonalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $personal = Personal::with("cargo","vinculo","tipoUsuario","departamento","provincia","distrito")->get();
            $maxid=Personal::max('id');
            return response()->json(["personal" => $personal, "success" => true,"maxid" => $maxid], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), "success" => false], 500);
        }
    }
    public function pagination(Request $request)
    {
        $areas = Personal::with("cargo","vinculo","tipoUsuario","departamento","provincia","distrito","tiposUbigeo");
        return DataTables::of($areas)->make(true);
    }

    public function uploadCv(Request $request){
        try{
            
            $personal = Personal::find($request->id);
            if($personal->cv){
                if(file_exists($personal->cv)){
                    unlink($personal->cv);
                }
            }
            $url=$request->file('cv')->store('public/documents/personal/cv');
            $save=explode('public/',$url);
            $personal->cv = implode("",$save);
            $personal->save();
            return response()->json(["success" => true,"message" => "cv cargado correctamente"], 200);
        }catch (Exception $e){
            return response()->json(["message"=>$e->getMessage(),"success"=>false],500);
        }
    }
    public function uploadImage(Request $request){
        try{
            $personal = Personal::find($request->id);
            if($personal->image){
                if(file_exists($personal->image)){
                    unlink($personal->image);
                }
            }
            $url=$request->file('image')->store('public/images/personal');
            $save=explode('public/',$url);
            $personal->foto = implode("",$save);
            $personal->save();
            return response()->json(["success" => true,"message" => "imagen cargada correctamente"], 200);
        }catch (Exception $e){
            return response()->json(["message"=>$e->getMessage(),"success"=>false],500);
        }
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
            $personal=new Personal();
            $personal->nombres=$request->nombres;
            $personal->cargo_id=$request->cargo_id;
            $personal->ppd=$request->ppd;
            $personal->perfil=$request->perfil;
            $personal->foto=null;
            $personal->cv=null;
            $personal->url_facebook=$request->url_facebook;
            $personal->url_1=$request->url_1;
            $personal->url_2=$request->url_2;
            $personal->puesto_id=$request->cargo_id;
            $personal->nombreCorto=$request->nombre_corto;
            $personal->telefono=$request->telefono;
            $personal->referencias=$request->referencias;
            $personal->estado=$request->estado;
            $personal->vinculo_id=$request->vinculo_id;
            $personal->dni=$request->dni;
            $personal->clave=$request->clave;
            $personal->fecha_ingreso=$request->fecha_ingreso;
            $personal->correo=$request->correo;
            $personal->sugerencias="";
            $personal->tipo_usuarios_id=$request->tipo_usuarios_id;
            $personal->asignar_usuarios="";
            $personal->observaciones="";
            $personal->tipo_ubigeo=$request->tipo_ubigeo;
            $personal->rol_id=1;
            $personal->departamento=$request->departamento;
            $personal->provincia=$request->provincia;
            $personal->distrito=$request->distrito;
            $personal->save();
            return response()->json(["personal" => $personal, "success" => true,"message"=>"Personal creado con exito"], 200);

        }catch(Exception $e){
            return response()->json(['message' => $e->getMessage(), "success" => false], 500);
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
        //
        try{
            $personal=Personal::find($id);
            $personal->cargo;
            $personal->puesto;
            $personal->tipoUsuario;
            return response()->json(["personal" => $personal, "success" => true], 200);
        }catch(Exception $e){
            return response()->json(['message' => $e->getMessage(), "success" => false], 500);
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
        //
        try{
            $personal= Personal::find($id);
            $personal->nombres=$request->nombres;
            $personal->cargo_id=$request->cargo_id;
            $personal->ppd=$request->ppd;
            $personal->perfil=$request->perfil;
            $personal->url_facebook=$request->url_facebook;
            $personal->url_1=$request->url_1;
            $personal->url_2=$request->url_2;
            $personal->puesto_id=$request->cargo_id;
            $personal->nombreCorto=$request->nombre_corto;
            $personal->telefono=$request->telefono;
            $personal->referencias=$request->referencias;
            $personal->vinculo_id=$request->vinculo_id;
            $personal->dni=$request->dni;
            $personal->clave=$request->clave;
            $personal->estado=$request->estado;
            $personal->tipo_ubigeo=$request->tipo_ubigeo;
            $personal->fecha_ingreso=$request->fecha_ingreso;
            $personal->correo=$request->correo;
            $personal->sugerencias="";
            $personal->tipo_usuarios_id=$request->tipo_usuarios_id;
            $personal->observaciones="";
            $personal->departamento=$request->departamento;
            $personal->provincia=$request->provincia;
            $personal->distrito=$request->distrito;
            $personal->save();
            return response()->json(["personal" => $personal, "success" => true,"message" => "Personal actualizado con exito"], 200);
        }catch(Exception $e){
            return response()->json(['message' => $e->getMessage(), "success" => false], 500);
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
            $personal=Personal::find($id);
            $personal->delete();
            return response()->json(["personal" => $personal, "success" => true,"message"=>"Personal eliminado con exito"], 200);
        }catch(Exception $e){
            return response()->json(['message' => $e->getMessage(), "success" => false], 500);
        }
    }
}
