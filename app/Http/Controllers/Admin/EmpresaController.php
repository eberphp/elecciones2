<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Perfil;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\DatosEmpresa;
use App\Models\RedesSociales;
use App\Models\Titulo;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = User::all();
        return view('intranet.pages.admin.empresas.index')->with(compact('usuarios'));
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
        $empresa = Perfil::create([
            'tipo' => 'empresa',
            'nombres' => $request->nombres.' '.$request->apellidos,
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
            'lugar' => $request->lugar
        ]);

        $usuario = User::create([
            'idPerfil' => $empresa->id,
            'email' => $request->usuario,
            'password' => bcrypt($request->password),
            'clave' => $request->password,
        ]);

        $datos = DatosEmpresa::create([
            'idUsuario' => $usuario->id,
            'idPerfil' => $empresa->id
        ]);

        $redes = RedesSociales::create([
            'idUsuario' => $usuario->id,
            'idPerfil' => $empresa->id
        ]);

        $titulos = Titulo::create([
            'idUsuario' => $usuario->id,
        ]);

        return redirect()->route('empresas.admin');
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
