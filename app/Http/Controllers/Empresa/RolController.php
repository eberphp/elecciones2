<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rol;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuario = auth()->user();
        $roles = Rol::where('idUsuarioCreador', $usuario->id)->where('estado','activo')->get();
        return view('intranet.pages.empresa.roles.roles')->with(compact('roles'));
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
        $usuario = auth()->user();
        Rol::create([
            'rol' => $request->rol,
            'idUsuarioCreador' => $usuario->id,
            'estado' => 'activo'
        ]);

        return back();
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
        $rol = Rol::find($id);
        $rol->rol = $request->rol;
        $rol->save();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rol = Rol::find($id);
        if ($rol->estado == 'activo') {
            $rol->estado = 'inactivo';
        } else {
            $rol->estado = 'activo';
        }
        $rol->save();
        //dd($rol);
        return back();
    }
}
