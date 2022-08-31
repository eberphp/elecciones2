<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Departamento;
use App\Models\Distrito;
use App\Models\DocumentosMesa;
use App\Models\LocalVotacion;
use App\Models\Provincia;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class LocalVotacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getLocalesVotacion(Request $request, $departamento, $provincia, $distrito)
    {
        $departamento = Departamento::where("id", $departamento)->first();
        $provincia = Provincia::where("id", $provincia)->first();
        $distrito = Distrito::where("id", $distrito)->first();
        $localesvotacion = LocalVotacion::where('departamento', $departamento->departamento)->where('provincia', $provincia->provincia)
            ->where('distrito', $distrito->distrito)->get();
        return response()->json($localesvotacion);
    }
    public function pagination(Request $request)
    {
        $locales = LocalVotacion::select(["*"]);
        return DataTables::of($locales)->make(true);
    }

    public function view()
    {
        $departamentos = Departamento::all();
        return view("intranet.pages.empresa.elecciones.locales_votacion", compact("departamentos"));
    }
    public function index()
    {
        //

    }
    public function filesLocalVotacion(Request $request, $local, $eleccion)
    {
        $files = DocumentosMesa::where("mesa_id", $local)->where("eleccion_id", $eleccion)->get();
        return response()->json(["success" => true, "files" => $files]);
    }
    public function uploadFiles(Request $request)
    {
        try {
            $eleccion = $request->eleccion;
            $local = $request->local;
            $documentosMesa = new DocumentosMesa();

            $url = $request->file('documento')->store('public/votaciones/actas');
            $save = explode('public/', $url);
            $documentosMesa->file_path = implode("", $save);
            $documentosMesa->file_name = $request->file("documento")->getClientOriginalName();
            $documentosMesa->file_type = $request->file("documento")->getClientOriginalExtension();
            $documentosMesa->eleccion_id = $eleccion;
            $documentosMesa->mesa_id = $local;
            $documentosMesa->save();
            return response()->json(["success" => true, "message" => "imagen cargada correctamente"], 200);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage(), "success" => false]);
        }
    }
    public function deleteFile(Request $request)
    {
        try {
            $documentoMesa =  DocumentosMesa::find($request->id);
            if ($documentoMesa) {
                if ($documentoMesa->file_path) {
                    if (file_exists(public_path("storage/".$documentoMesa->file_path))) {
                        unlink(public_path("storage/".$documentoMesa->file_path));
                    }
                }
                $documentoMesa->delete();
            }
            return response()->json(["success" => true, "message" => "Eliminado correctamente"]);
        } catch (Exception $e) {
            return response()->json(["message" => "error: " . $e->getMessage(), "success" => false]);
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
        //
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
    }
}
