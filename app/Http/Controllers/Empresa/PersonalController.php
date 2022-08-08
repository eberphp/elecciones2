<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use App\Models\Cargo;
use App\Models\DatosEmpresa;
use App\Models\Departamento;
use App\Models\EstadoEvaluacion;
use App\Models\Funcion;
use Illuminate\Http\Request;
use App\Models\Perfil;
use App\Models\Personal;
use App\Models\TipoUbigeo;
use App\Models\TipoUsuario;
use App\Models\User;
use App\Models\Vinculo;
use Exception;
use Illuminate\Support\Facades\Hash;

class PersonalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $personal = Personal::orderBy('id', 'desc')->paginate(10);
        return view('intranet.pages.empresa.personal.index', compact('personal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cargos = Cargo::all();
        $puestos = $cargos;
        $vinculos = Vinculo::all();
        $funciones = Funcion::all();
        $tipoUsuarios = TipoUsuario::all();
        $tipoUbigeos = TipoUbigeo::all();
        $estadoEvaluaciones = EstadoEvaluacion::all();
        $departamentos = Departamento::all();
        return view('intranet.pages.empresa.personal.create', compact('cargos', 'puestos', 'vinculos', 'funciones', 'tipoUsuarios', 'tipoUbigeos', 'estadoEvaluaciones', 'departamentos'));
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
                $request->session()->flash('error', 'El correo ya existe en la base de datos');
                return redirect()->route("personalweb.create")->withInput();
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
            $request->session()->flash("success", "Se ha registrado correctamente el personal");
            return redirect()->route('personalweb.index')->with('success', 'Personal creado con éxito');
        } catch (Exception $e) {
            $request->session()->flash("error", "No se ha podido registrar el personal");
            return back()->withErrors('error', 'Error al crear el personal verifique los datos')->withInput();
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $personal = Personal::find($id);
        $cargos = Cargo::all();
        $puestos = $cargos;
        $vinculos = Vinculo::all();
        $funciones = Funcion::all();
        $tipoUsuarios = TipoUsuario::all();
        $tipoUbigeos = TipoUbigeo::all();
        $estadoEvaluaciones = EstadoEvaluacion::all();
        $departamentos = Departamento::all();
        return view('intranet.pages.empresa.personal.edit', compact('personal', 'cargos', 'puestos', 'vinculos', 'funciones', 'tipoUsuarios', 'tipoUbigeos', 'estadoEvaluaciones', 'departamentos'));
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
