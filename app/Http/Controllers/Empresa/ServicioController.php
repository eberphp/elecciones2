<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Servicio;
use App\Models\Titulo;

class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $titulos = Titulo::where('idUsuario', auth()->user()->id)->first();
        //$servicios = Servicio::where('idUsuario', auth()->user()->id)->orderBy('orden', 'asc')->get();
        $servicios = Servicio::where('idUsuario', auth()->user()->id)->orderBy('nombre', 'asc')->get();
        return view('intranet.pages.empresa.web.servicios.index')->with(compact('titulos','servicios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('intranet.pages.empresa.web.servicios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $servicio = Servicio::create([
            'idUsuario' => auth()->user()->id,
            'codigo' => $request->id,
            'nombre' => $request->nombre,
            'orden' => $request->orden,
            'url' => $request->url
        ]);

        return redirect()->route('servicios.index'); 
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
        $servicio = Servicio::find($id);
        return view('intranet.pages.empresa.web.servicios.edit')->with(compact('servicio'));
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
        $servicio = Servicio::find($id);
        $servicio->codigo = $request->id;
        $servicio->nombre = $request->nombre;
        $servicio->orden = $request->orden;
        $servicio->url = $request->url;
        $servicio->save();

        return redirect()->route('servicios.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $servicio =Servicio::find($id);
        $servicio->delete();
        return back();
    }
}
