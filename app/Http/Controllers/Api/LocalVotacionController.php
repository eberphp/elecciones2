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
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Str;

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
        $locales = DB::table("locales_votacion")->select(["*"]);
        return DataTables::of($locales)->make(true);
    }
    public function searchNroMesa(Request $request, $nro_mesa)
    {
        try {
            $local = LocalVotacion::where("num_mesa", $nro_mesa)->first();
            $departamento = Departamento::where("departamento", $local->departamento)->first();
            $provincia = Provincia::where("idDepartamento", $departamento->id)->where("provincia", $local->provincia)->first();
            $distrito = Distrito::where("idDepartamento", $departamento->id)->where("idProvincia", $provincia->id)->where("distrito", $local->distrito)->first();
            return response()->json(["success" => true, "local" => $local, "departamento" => $departamento, "provincia" => $provincia, "distrito" => $distrito]);
        } catch (Exception $e) {
            return response()->json(["success" => false, "message" => $e->getMessage()]);
        }
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
    public function filesLocalVotacion(Request $request, $local, $eleccion, $tipo)
    {
        $files = DocumentosMesa::where("mesa_id", $local)->where("eleccion_id", $eleccion)->where("tipo", $tipo)->where("status", "activo")->get();
        return response()->json(["success" => true, "files" => $files]);
    }
    public function uploadFiles(Request $request)
    {
        try {
            $eleccion = $request->eleccion;
            $local = $request->local;
            $documentosMesa = new DocumentosMesa();

            $docfile = $request->file('documento');

            $nombreDocumento = Str::slug($docfile->getClientOriginalName() . microtime()) . "." . $docfile->getClientOriginalExtension();
            $rutasave = "public/votaciones/actas";
            $path = Storage::putFileAs($rutasave, $docfile, $nombreDocumento);

            $url = $rutasave . "/" . $nombreDocumento;
            $save = explode('public/', $url);
            $documentosMesa->file_path = implode("", $save);
            $documentosMesa->file_name = $request->file("documento")->getClientOriginalName();
            $documentosMesa->file_type = $request->file("documento")->getClientOriginalExtension();
            $documentosMesa->eleccion_id = $eleccion;
            $documentosMesa->mesa_id = $local;
            $documentosMesa->user_id = $request->user() ? $request->user()->id : 1;
            $documentosMesa->tipo = $request->tipo;
            $documentosMesa->save();
            return response()->json(["success" => true, "message" => "imagen cargada correctamente"], 200);
        } catch (Exception $e) {
            return response()->json(["message" => "El archivo no se puede subir", "success" => false]);
        }
    }
    public function deleteFile(Request $request)
    {
        try {
            $documentoMesa =  DocumentosMesa::find($request->id);
            if ($documentoMesa) {
                /* if ($documentoMesa->file_path) {
                    if (file_exists(public_path("storage/" . $documentoMesa->file_path))) {
                        unlink(public_path("storage/" . $documentoMesa->file_path));
                    }
                } */
                $documentoMesa->status = "eliminado";
                $documentoMesa->delated_by = $request->user()->id;
                $documentoMesa->save();
            }
            return response()->json(["success" => true, "message" => "Eliminado correctamente"]);
        } catch (Exception $e) {
            return response()->json(["message" => "error: " . $e->getMessage(), "success" => false]);
        }
    }
    public function uploadFilesWeb(Request $request)
    {
        try {
            $eleccion = $request->eleccion;
            $local = $request->local;
            $documentosMesa = new DocumentosMesa();

            $docfile = $request->file('documento');

            $nombreDocumento = Str::slug($docfile->getClientOriginalName() . microtime()) . "." . $docfile->getClientOriginalExtension();
            $rutasave = "public/votaciones/actas";
            $path = Storage::putFileAs($rutasave, $docfile, $nombreDocumento);

            $url = $rutasave . "/" . $nombreDocumento;
            $save = explode('public/', $url);
            $documentosMesa->file_path = implode("", $save);
            $documentosMesa->file_name = $request->file("documento")->getClientOriginalName();
            $documentosMesa->file_type = $request->file("documento")->getClientOriginalExtension();
            $documentosMesa->eleccion_id = $eleccion;
            $documentosMesa->mesa_id = $local;
            $documentosMesa->user_id = $request->user("personal") ? $request->user("personal")->id : 1;
            $documentosMesa->tipo = $request->tipo;
            $documentosMesa->save();
            return response()->json(["success" => true, "message" => "imagen cargada correctamente"], 200);
        } catch (Exception $e) {
            return response()->json(["message" => "El archivo no se puede subir", "success" => false]);
        }
    }
    public function deleteFileWeb(Request $request)
    {
        try {
            $documentoMesa =  DocumentosMesa::find($request->id);
            if ($documentoMesa) {
                $documentoMesa->status = "eliminado";
                $documentoMesa->delated_by = $request->user("personal")->id;
                $documentoMesa->save();
            }
            return response()->json(["success" => true, "message" => "Eliminado correctamente"]);
        } catch (Exception $e) {
            return response()->json(["message" => "error: " . $e->getMessage(), "success" => false]);
        }
    }
    public function validatePassword(Request $request)
    {
        try {
            $local = $request->local;
            $clave = $request->password;
            $localexiste = LocalVotacion::find($local);
            if ($localexiste) {
                if ($localexiste->clave == $clave) {
                    return response()->json(["success" => true, "message" => "Acceso permitido"]);
                }
                return response()->json(["success" => false, "message" => "La contraseña ingresada es incorrecta"]);
            }
            return response()->json(["success" => false, "message" => "Local de votacion no encontrado"]);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage(), "success" => false]);
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

    public function truncAndInsertLocalesVotacion(Request $request)
    {
        try {
            $path = public_path('locales.sql');
            $sql = file_get_contents($path);
            DB::unprepared($sql);
            return response()->json("ok");
        } catch (Exception $e) {
            return response()->json(["message" => "El archivo no se puede subir", "success" => false]);
        }
    }
}
