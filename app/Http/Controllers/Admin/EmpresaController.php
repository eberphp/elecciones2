<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Perfil;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\DatosEmpresa;
use App\Models\RedesSociales;
use App\Models\Titulo;
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
            if (!file_exists('/var/www/' . $texto)) {
                try {
                    $comando = exec("sh /var/www/bjar.sh $texto");
                } catch (ValidationException $e) {
                    Log::error('comando: ' . json_encode($e));
                }
            }


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
