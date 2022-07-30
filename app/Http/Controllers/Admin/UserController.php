<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Perfil;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = User::all();
        return view('intranet.pages.admin.usuarios.index')->with(compact('usuarios'));
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

    public function createUser(){
        $perfil = Perfil::create([
            'tipo' => 'admin',
            'codigo' => 'ADMIN01',
            'nombres' => 'Enrique Vargas',
            'telefono' => '987654321',
            'nombreCorto' => 'Enrique',
            'docIdentidad' => '12345678',
            'edad' => 26,
            'fechaNacimiento' => '1996-01-23',
            'profesion' => 'Desarrollador',
            'cargo' => 'Desarrollador',
            'correo' => 'admin@gmail.com',
            'lugar' => 'Trujillo',
            'empresa' => 'SIGE',
            'ruc' => '10123456786',
            'observaciones' => 'Ni una'
        ]);

        $usuario = User::create([
            'idPerfil' => $perfil->id,
            'email' => $perfil->correo,
            'password' => bcrypt('123456'),
            'clave' => '123456',
        ]);

        return $usuario;
    }
}
