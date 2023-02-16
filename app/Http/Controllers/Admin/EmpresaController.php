<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Perfil;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\DatosEmpresa;
use App\Models\RedesSociales;
use App\Models\Titulo;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $us = User::with('perfil.datos_empresa')->get();
        $usuarios = $us->map(function ($u) {
            $d = 'no crear';

            if ($u->perfil->datos_empresa) {
                $d =  file_exists('/var/www/' . $u->perfil->datos_empresa->dominio);
            }
            $u->proyecto_creado = $d;

            return $u;
        });
        return view('intranet.pages.admin.empresas.index')->with(compact('usuarios'));
    }

    public function crearProyecto($texto)
    {
        try {
            $empresa = DatosEmpresa::find($texto);

            if (!file_exists('/var/www/' . $empresa->dominio)) {
                try {
                    $comando = exec("sh /var/www/bjar.sh $empresa->dominio");
                    return $comando;
                } catch (ValidationException $e) {
                    return $e;
                    Log::error('comando: ' . json_encode($e));
                }
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function actualizarGit()
    {
        try {

            exec("sh /var/www/bjar-for.sh", $respuesta, $return_var);

            $nueva_lista = [];

            foreach ($respuesta as $d) {
                $nueva_lista[] = limpiar_datos($d, ['/var/www/', '---> Proyecto Actualizado', ' ']);
            }
            Artisan::call("storage:link");
            return $nueva_lista;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('intranet.pages.admin.empresas.create');
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


            $perfil = Perfil::create([
                'tipo' => 'empresa',
                'nombres' => $request->nombres . ' ' . $request->apellidos,
                'telefono' => $request->telefono,
                'nombreCorto' => $request->nombreCorto,
                'edad' => $request->edad,
                'fechaNacimiento' => $request->fechaNacimiento,
                'profesion' => $request->profesion,
                'cargo' => $request->cargo,
                'docIdentidad' => $request->docIdentidad,
                'correo' => $request->usuario,
                'empresa' => $request->empresa,
                'ruc' => $request->ruc,
                'codigo' => $request->codigo,
                'lugar' => $request->lugar,
            ]);

            $texto      = str_replace(["//", "/", "http", "https", ":"], '', $request->dominio);


            $empresa = DatosEmpresa::create([
                // 'datos_empresa_id' => $usuario->id,
                'perfil_id' => $perfil->id,
                'dominio'   => $texto,
                'visitas'   => $request->visitas,
            ]);

            $usuario = User::create([
                'perfil_id' => $perfil->id,
                'email' => $request->usuario,
                'password' => bcrypt($request->password),
                'clave' => $request->password,
                'datos_empresa_id'  => $empresa->id
            ]);

            //$domain     = explode("//", $texto);
            //$domain_aux = $domain[1];

            $redes = RedesSociales::create([
                'datos_empresa_id' => $empresa->id,
                'perfil_id' => $perfil->id
            ]);

            $titulos = Titulo::create([
                'datos_empresa_id' => $empresa->id,
            ]);



            DB::commit();
            //if (!file_exists('/var/www/' . $texto)) {
            //    try {
            //        $comando = exec("sh /var/www/bjar.sh $texto");
            //    } catch (ValidationException $e) {
            //        Log::error('comando: ' . json_encode($e));
            //    }
            //}


            return redirect()->route('empresas.admin');
        } catch (ValidationException $e) {
            //DB::rollBack();
            Log::error('EmpresaController: ' . json_encode($e));
            return redirect()->route('empresas.admin');
            // return $e->getMessage();
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
        $perfil = Perfil::find($id);
        $usuario = User::where('perfil_id', $id)->first();
        $empresa = DatosEmpresa::where('perfil_id', $id)->first();
        return view('intranet.pages.admin.empresas.edit')->with(compact('perfil', 'usuario', 'empresa'));
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
        $perfil = Perfil::find($id);
        $perfil->nombres = $request->nombres . ' ' . $request->apellidos;
        $perfil->telefono = $request->telefono;
        $perfil->nombreCorto = $request->nombreCorto;
        $perfil->edad = $request->edad;
        $perfil->fechaNacimiento = $request->fechaNacimiento;
        $perfil->profesion = $request->profesion;
        $perfil->cargo = $request->cargo;
        $perfil->docIdentidad = $request->docIdentidad;
        $perfil->correo = $request->usuario;
        $perfil->empresa = $request->empresa;
        $perfil->ruc = $request->ruc;
        $perfil->codigo = $request->codigo;
        $perfil->lugar = $request->lugar;
        $perfil->save();

        $texto      = str_replace(["//", "/", "http", "https", ":"], '', $request->dominio);

        $empresa = DatosEmpresa::where('perfil_id', $id)->first();
        $empresa->dominio = $texto;
        $empresa->visitas = $request->visitas;
        $empresa->save();

        /*$usuario = User::create([
            'perfil_id' => $perfil->id,
            'email' => $request->usuario,
            'password' => bcrypt($request->password),
            'clave' => $request->password,
            'datos_empresa_id'  => $empresa->id
        ]);*/

        $usuario = User::where('perfil_id', $id)->first();
        $usuario->email = $request->usuario;
        $usuario->clave = $request->password;
        $usuario->password = bcrypt($request->password);
        $usuario->save();

        return redirect()->route('empresas.admin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = User::where('perfil_id', $id)->first();
        $usuario->delete();

        $perfil = Perfil::find($id);
        $perfil->delete();


        return back();
    }
}
