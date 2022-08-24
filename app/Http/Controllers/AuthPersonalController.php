<?php

namespace App\Http\Controllers;

use App\Models\Boton;
use App\Models\Cargo;
use App\Models\DatosEmpresa;
use App\Models\Departamento;
use App\Models\EstadoEvaluacion;
use App\Models\Funcion;
use App\Models\Perfil;
use App\Models\Personal;
use App\Models\Publicacion;
use App\Models\RedesSociales;
use App\Models\Servicio;
use App\Models\Slider;
use App\Models\Testimonio;
use App\Models\TipoUbigeo;
use App\Models\TipoUsuario;
use App\Models\Titulo;
use App\Models\User;
use App\Models\Vinculo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthPersonalController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string']
        ]);
        $bool = false;
        if (isset($request->remember)) {
            if ($request->remember == "on") {
                $bool = true;
            }
        }
        $credentialsauth = [
            "correo" => $request->email,
            "password" => $request->password,
            "clave" => $request->password
        ];
        if (Auth::guard('personal')->attempt($credentialsauth, $bool)) {

            if (Auth::guard('personal')->user()->datos_empresa_id != idEmpresa()) {
                Auth::guard('personal')->logout();
                return back()->withErrors([
                    'email' => 'Usuario incorrecto.',
                    'password' => 'Contraseña incorrecto.'
                ]);
            }
            $request->session()->regenerate();
            return redirect()->to('/');
        }
        return back()->withErrors([
            'email' => 'Usuario incorrecto.',
            'password' => 'Contraseña incorrecto.'
        ]);
    }
    public function logout(Request $request)
    {
        Auth::guard('personal')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return back();
    }
    public function index()
    {
        return view("web.pages.auth.login");
    }
    public function profile()
    {
        $id = idEmpresa();
        $redes = RedesSociales::where('datos_empresa_id', $id)->first();
        $personal = Personal::where("id", Auth::guard('personal')->user()->id)->first();
        $cargos = Cargo::all();
        $puestos = $cargos;
        $vinculos = Vinculo::all();
        $funciones = Funcion::all();
        $tipoUsuarios = TipoUsuario::all();
        $tipoUbigeos = TipoUbigeo::all();
        $estadoEvaluaciones = EstadoEvaluacion::all();
        $departamentos = Departamento::all();
        return view("web.pages.auth.profile", compact("funciones", "tipoUbigeos", "tipoUsuarios", "cargos", "puestos", "vinculos", "departamentos", "estadoEvaluaciones", "personal"));
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
        return view("web.pages.auth.register", compact("funciones", "tipoUbigeos", "tipoUsuarios", "cargos", "puestos", "vinculos", "departamentos", "estadoEvaluaciones"));
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

            DB::beginTransaction();
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
            $correoregistrado = Personal::where("correo", $request->correo)->first();
            if ($correoregistrado) {
                return back()->withErrors([
                    'email' => 'El correo ya esta registrado.',
                ])->withInput();
            }
            $personal = new Personal();
            $personal->nombres = isset($request->name) ? $request->name : "";
            $personal->datos_empresa_id = 1/* idEmpresa() */;
            $personal->empresa_id = 1 /* idEmpresa() */;
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
            $personal->clave = isset($request->password) ? $request->password : "";
            $personal->fecha_ingreso = isset($request->fecha_ingreso) ? $request->fecha_ingreso : "";
            if ($request->clave) {
                $personal->clave = $request->clave;
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
            $personal->save();

            $lastidpersonal = Personal::max("id");
            $lastidpersonal++;
            $lastidperfil = Perfil::max("id");
            $lastidperfil++;
            $perfil = new Perfil();
            $perfil->id = $lastidperfil;
            $perfil->tipo = "persona";
            $perfil->codigo = isset($request->dni) ? $request->dni : "";
            $perfil->telefono = isset($request->telefono) ? $request->telefono : "";
            $perfil->nombreCorto = isset($request->nombre_corto) ? $request->nombre_corto : "";
            $perfil->docIdentidad = isset($request->dni) ? $request->dni : "";
            $perfil->idUsuarioCreador = isset(Auth::user()->id) ? Auth::user()->id : 0;
            $perfil->save();

            //dd(idEmpresa());

            $user = new User();
            $user->perfil_id=$lastidperfil;
            $user->idPersonal = $lastidpersonal;
            $user->password = Hash::make($request->clave);
            $user->clave = $request->clave;
            $user->datos_empresa_id = 1 /* idEmpresa() */;
            //$user->clave = $request->clave;
            $user->email = $request->correo;
            $user->save();
            DB::commit();
            return back()->with('success', 'Su cuenta fue creada correctamente ');
        } catch (Exception $e) {
            return back()->withErrors([
                "name" => $e->getMessage()
            ])->withInput();
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
