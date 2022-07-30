<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Boton;

class BotonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $botones = Boton::where('idUsuario', auth()->user()->id)->orderBy('orden', 'asc')->get();
        return view('intranet.pages.empresa.web.botones.index')->with(compact('botones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('intranet.pages.empresa.web.botones.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $boton = Boton::create([
            'idUsuario' => auth()->user()->id,
            'codigo' => $request->id,
            'nombre' => $request->nombre,
            'orden' => $request->orden,
            'url' => $request->url,
            'colorFondo' => $request->colorFondo
        ]);

        return redirect()->route('botones.index');
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
        $boton = Boton::find($id);
        return view('intranet.pages.empresa.web.botones.edit')->with(compact('boton'));
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
        $boton = Boton::find($id);
        $boton->codigo = $request->id;
        $boton->nombre = $request->nombre;
        $boton->orden = $request->orden;
        $boton->url = $request->url;
        $boton->colorFondo = $request->colorFondo;
        $boton->save();

        return redirect()->route('botones.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $boton = Boton::find($id);
        $boton->delete();
        return back();
    }
}
