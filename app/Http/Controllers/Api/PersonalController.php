<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Asignacion;
use App\Models\DatosEmpresa;
use App\Models\Perfil;
use App\Models\Personal;
use App\Models\Permiso;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;
use Response;
//use Auth;

class PersonalController extends Controller
{
    protected const MSG_SCS_CRTROL = 'Roles asignados exitosamente.';
    protected const MSG_ERR_CRTROL = 'Ocurrió un problema mientras se intentaba asignar roles.';
    protected const MSG_SCS_DLTROL = 'Roles eliminados exitosamente.';
    protected const MSG_ERR_DLTROL = 'Ocurrió un problema mientras se intentaba eliminar roles.';
    protected const MSG_NOT_FNDPER = 'El personal solicitado no ha sido encontrado.';
    protected const MSG_NOT_FNDROL = 'El rol solicitado no ha sido encontrado.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function clearPersonal()
    {
        $permisos = Asignacion::all();
        foreach ($permisos as $permiso) {
            $permiso->delete();
        }
        $personal = Personal::all();
        foreach ($personal as $value) {
            $user = User::where("idPersonal", $value->id)->first();
            $perfil = Perfil::find($user->idPerfil);
            $perfil->delete();
            $user->delete();

            $value->delete();
        }
    }
    public function index()
    {
        try {
            $personal = Personal::with("cargo", "vinculo", "tipoUsuario", "departamentos", "provincias", "distritos", "funcion")->get();
            $maxid = Personal::max('id');
            return response()->json(["personal" => $personal, "success" => true, "maxid" => $maxid], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), "success" => false], 500);
        }
    }
    public function pagination(Request $request)
    {
        $areas = Personal::with("cargo", "funcion", "vinculo", "tipoUsuario", "departamentos", "provincias", "distritos", "tiposUbigeo");
        return DataTables::of($areas)->make(true);
    }

    public function uploadCv(Request $request)
    {
        try {
            $personal = Personal::find($request->id);
            if ($personal->cv) {
                if (file_exists($personal->cv)) {
                    unlink($personal->cv);
                }
            }
            $url = $request->file('cv')->store('public/documents/personal/cv');
            $save = explode('public/', $url);
            $personal->cv = implode("", $save);
            $personal->save();
            return response()->json(["success" => true, "message" => "cv cargado correctamente"], 200);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage(), "success" => false], 500);
        }
    }
    public function uploadImage(Request $request)
    {
        try {
            $personal = Personal::find($request->id);
            if ($personal->image) {
                if (file_exists($personal->image)) {
                    unlink($personal->image);
                }
            }
            $url = $request->file('image')->store('public/images/personal');
            $save = explode('public/', $url);
            $personal->foto = implode("", $save);
            $personal->save();
            return response()->json(["success" => true, "message" => "imagen cargada correctamente"], 200);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage(), "success" => false], 500);
        }
    }

    /* Roles: Ricardo Bejar */
    public function asignarRoles(Request $request)
    {
        $request->validate([
            'personal_id' => 'required|integer|min:1',
            'permisos' => 'required|array',
        ], self::validationErrorMessages());

        $personal = Personal::find($request->personal_id);

        if (!$personal)
            return response()->json(['success' => 'false', 'errors' => ['message' => self::MSG_NOT_FNDPER]], 404);

        foreach ($personal->asignaciones as $asignacion) //elimino permisos fuera de la lista
            if (!in_array($asignacion->permiso_id, $request->permisos))
                if (!$asignacion->delete())
                    return response()->json(['success' => 'false', 'errors' => ['message' => self::MSG_ERR_DLTROL]], 503);

        foreach ($request->permisos as $permiso_id) { //agrego los permisos sin registrar
            if (!Asignacion::where(['personal_id' => $personal->id, 'permiso_id' => $permiso_id])->first()) {
                if (!Asignacion::create([
                    'personal_id' => $personal->id,
                    'permiso_id' => $permiso_id,
                    //'created_by' => auth()->user()->id
                ]))
                    return response()->json(['success' => 'false', 'errors' => ['message' => self::MSG_ERR_CRTROL]], 503);
            }
        }
        return response()->json(['success' => 'true', 'message' => self::MSG_SCS_CRTROL], 201);
    }

    public function obtenerRoles(Request $request, $id)
    {
        $personal = Personal::find($id);

        if (!$personal)
            return response()->json(['success' => 'false', 'errors' => ['message' => self::MSG_NOT_FNDPER]], 404);

        return $personal->asignaciones;
    }
    /* Roles: Fin */

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
            $userexiste = User::where("email", $request->correo)->first();
            if ($userexiste) {
                return response()->json(['success' => false, 'message' => 'El correo ya existe']);
            }
            $foto = $request->file("foto");
            $cv = $request->file("cv");
            $save1 = "";
            $foto_url = "";
            if ($foto) {
                $url = $foto->store('public/images/personal');
                $save1 = explode('public/', $url);
                $foto_url = implode("", $save1);
            }
            $cv_url = "";
            $save2 = "";
            if ($cv) {
                $url = $cv->store('public/documents/personal/cv');
                $save2 = explode('public/', $url);
                $cv_url = implode("", $save2);
            }

            $urlfacebook = "";
            if (isset($request->url_facebook) && strpos($request->url_facebook, "http")) {
                $urlfacebook = $request->url_facebook;
            } else {
                $urlfacebook = "https://" . $request->url_facebook;
            }
            $url1 = "";
            if (isset($request->url_1) && strpos($request->url_1, "http")) {
                $url1 = $request->url_1;
            } else {
                $url1 = "https://" . $request->url_1;
            }
            $url2 = "";
            if (isset($request->url_2) && strpos($request->url_2, "http")) {
                $url2 = $request->url_2;
            } else {
                $url2 = "https://" . $request->url_2;
            }
            $lastidpersonal = Personal::max("id");
            if ($lastidpersonal == null) {
                $lastidpersonal = 0;
            }
            $lastidpersonal++;
            $lastidperfil = Perfil::max("id");
            if ($lastidperfil == null) {
                $lastidperfil = 0;
            }

            $lastidperfil++;

            $usuarioregistrador = User::find($request->user_id);
            $perfilregistrador = Perfil::find($usuarioregistrador->idPerfil);
            $personal = new Personal();
            $personal->id = $lastidpersonal;
            $personal->nombres = isset($request->nombres) ? $request->nombres : "";
            $personal->cargo_id = isset($request->cargo_id) ? $request->cargo_id : 0;
            $personal->funcion_id = isset($request->funcion_id) ? $request->funcion_id : 0;
            $personal->ppd = isset($request->ppd) ? $request->ppd : "";
            $personal->perfil = isset($request->perfil) ? $request->perfil : "";
            $personal->evaluacion = isset($request->evaluacion) ? $request->evaluacion : "";
            $personal->foto = $foto_url;
            $personal->cv = $cv_url;
            $personal->url_facebook = isset($request->url_facebook) ? $urlfacebook : "";
            $personal->url_1 = isset($request->url_1) ? $url1 : "";
            $personal->url_2 = isset($request->url_2) ? $url2 : "";
            $personal->puesto_id = isset($request->cargo_id) ? $request->cargo_id : 0;
            $personal->nombreCorto = isset($request->nombre_corto) ? $request->nombre_corto : "";
            $personal->telefono = isset($request->telefono) ? $request->telefono : "";
            $personal->referencias = isset($request->referencias) ? $request->referencias : "";
            $personal->estado = isset($request->estado) ? $request->estado : "";
            $personal->vinculo_id = isset($request->vinculo_id) ? $request->vinculo_id : 0;
            $personal->dni =  $request->dni;
            $personal->clave = isset($request->clave) ? $request->clave : "";
            $personal->fecha_ingreso = isset($request->fecha_ingreso) ? $request->fecha_ingreso : "";
            if ($request->clave) {
                $personal->password = Hash::make($request->clave);
            }
            $personal->correo = isset($request->correo) ? $request->correo : "";
            $personal->sugerencias = isset($request->sugerencias) ? $request->sugerencias : "";
            $personal->tipo_usuarios_id = isset($request->tipo_usuarios_id) ? $request->tipo_usuarios_id : 0;
            $personal->asignar_usuarios = "" ? isset($request->asignar_usuarios) : "";
            $personal->observaciones = isset($request->observaciones) ? $request->observaciones : "";
            $personal->tipo_ubigeo = isset($request->tipo_ubigeo) ? $request->tipo_ubigeo : 0;
            $personal->rol_id = 1;
            $personal->departamento = isset($request->departamento) ? $request->departamento : 0;
            $personal->provincia = isset($request->provincia) ? $request->provincia : 0;
            $personal->distrito = isset($request->distrito) ? $request->distrito : 0;
            $datosempresa = null;
            if ($usuarioregistrador->personal) {
                $datosempresa = DatosEmpresa::find($usuarioregistrador->personal->empresa_id);
            } else {
                $datosempresa = DatosEmpresa::where("idPerfil", $perfilregistrador->id)->first();
            }
            $personal->empresa_id = $datosempresa->id;
            $personal->save();

            $perfil = new Perfil();
            $perfil->id = $lastidperfil;
            $perfil->tipo = "persona";
            $perfil->codigo = isset($request->dni) ? $request->dni : "";
            $perfil->nombres = isset($request->nombres) ? $request->nombres : "";
            $perfil->correo = isset($request->correo) ? $request->correo : "";
            $perfil->telefono = isset($request->telefono) ? $request->telefono : "";
            $perfil->nombreCorto = isset($request->nombre_corto) ? $request->nombre_corto : "";
            $perfil->docIdentidad = isset($request->dni) ? $request->dni : "";
            $perfil->idUsuarioCreador = $usuarioregistrador->id ? $usuarioregistrador->id : 0;
            $perfil->save();
            $user = new User();
            $user->idPerfil = $lastidperfil;
            $user->idPersonal = $lastidpersonal;
            $user->password = Hash::make($request->clave);
            $user->clave = $request->clave;
            $user->email = $request->correo;
            $user->save();

            return response()->json(["personal" => $personal, "success" => true, "message" => "Personal creado con exito"], 200);
        } catch (Exception $e) {
            return response()->json(["message" => "Error :" . $e->getMessage(), "success" => false, "user" => auth()->user()]);
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
        try {
            $personal = Personal::find($id);
            $personal->cargo;
            $personal->puesto;
            $personal->tipoUsuario;
            return response()->json(["personal" => $personal, "success" => true], 200);
        } catch (Exception $e) {
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
        try {
            $urlfacebook = "";
            if (isset($request->url_facebook) && strpos($request->url_facebook, "http")) {
                $urlfacebook = $request->url_facebook;
            } else {
                $urlfacebook = "https://" . $request->url_facebook;
            }
            $url1 = "";
            if (isset($request->url_1) && strpos($request->url_1, "http")) {
                $url1 = $request->url_1;
            } else {
                $url1 = "https://" . $request->url_1;
            }
            $url2 = "";
            if (isset($request->url_2) && strpos($request->url_2, "http")) {
                $url2 = $request->url_2;
            } else {
                $url2 = "https://" . $request->url_2;
            }

            $personal = Personal::find($id);
            $personal->nombres = isset($request->nombres) ? $request->nombres : "";
            $personal->cargo_id = isset($request->cargo_id) ? $request->cargo_id : 0;
            $personal->ppd = isset($request->ppd) ? $request->ppd : "";
            $personal->perfil = isset($request->perfil) ? $request->perfil : "";
            $personal->url_facebook = isset($request->url_facebook) ? $urlfacebook : "";
            $personal->url_1 = isset($request->url_1) ? $url1 : "";
            $personal->url_2 = isset($request->url_2) ? $url2 : "";
            $personal->puesto_id = isset($request->cargo_id) ? $request->cargo_id : 0;
            $personal->nombreCorto = isset($request->nombre_corto) ? $request->nombre_corto : "";
            $personal->telefono = isset($request->telefono) ? $request->telefono : "";
            $personal->referencias = isset($request->referencias) ? $request->referencias : "";
            if ($request->clave) {
                $personal->password = Hash::make($request->clave);
            }
            $personal->evaluacion = isset($request->evaluacion) ? $request->evaluacion : "";
            $personal->vinculo_id = isset($request->vinculo_id) ? $request->vinculo_id : 0;
            $personal->funcion_id = isset($request->funcion_id) ? $request->funcion_id : 0;
            $personal->dni = isset($request->dni) ? $request->dni : "";
            $personal->clave = isset($request->clave) ? $request->clave : "";
            $personal->estado = isset($request->estado) ? $request->estado : "";
            $personal->tipo_ubigeo = isset($request->tipo_ubigeo) ? $request->tipo_ubigeo : 0;
            $personal->fecha_ingreso = isset($request->fecha_ingreso) ? $request->fecha_ingreso : "";
            $personal->sugerencias = isset($request->sugerencias) ? $request->sugerencias : "";
            $personal->tipo_usuarios_id = isset($request->tipo_usuarios_id) ? $request->tipo_usuarios_id : 0;
            $personal->observaciones = isset($request->observaciones) ? $request->observaciones : "";
            $personal->departamento = isset($request->departamento) ? $request->departamento : 0;
            $personal->provincia = isset($request->provincia) ? $request->provincia : 0;

            $personal->observaciones = isset($request->observaciones) ? $request->observaciones : "";
            $personal->distrito = isset($request->distrito) ? $request->distrito : 0;
            $personal->save();



            $user = User::where("email", $request->correo)->first();
            $user->password = Hash::make($request->clave);
            $user->clave = $request->clave;
            $user->email = $request->correo;
            $user->save();
            $perfil = Perfil::find($user->idPerfil);
            $perfil->codigo = isset($request->dni) ? $request->dni : "";
            $perfil->correo = isset($request->correo) ? $request->correo : "";
            $perfil->nombres = isset($request->nombres) ? $request->nombres : "";
            $perfil->telefono = isset($request->telefono) ? $request->telefono : "";
            $perfil->nombreCorto = isset($request->nombre_corto) ? $request->nombre_corto : "";
            $perfil->docIdentidad = isset($request->dni) ? $request->dni : "";
            $perfil->save();

            return response()->json(["personal" => $personal, "success" => true, "message" => "Personal actualizado con exito"], 200);
        } catch (Exception $e) {
            return response()->json(['message' => "Error :" . $e->getMessage(), "success" => false]);
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
        try {

            $personal = Personal::find($id);
            $user = User::where("idPersonal", $personal->id)->first();
            $perfil = Perfil::find($user->idPerfil);
            if ($perfil) {
                $perfil->delete();
            }
            if ($user) {
                $user->delete();
            }

            $personal->delete();
            return response()->json(["personal" => $personal, "success" => true, "message" => "Personal eliminado con exito"], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), "success" => false], 500);
        }
    }

    protected static function validationErrorMessages()
    {
        return [
            'personal_id.required' => 'Debes ingresar obligatoriamente el ID del personal.',
            'personal_id.integer' => 'El ID de personal ingresado no tiene un formato válido.',
            'personal_id.min' => 'El ID de personal ingresado no es válido.',

            'permisos.required' => 'Debes seleccionar, al menos, un rol.',
            'permisos.array' => 'La lista de permisos ingresada no tiene un formato válido.',
        ];
    }
}
