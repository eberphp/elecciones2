<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Titulo;
use App\Models\Testimonio;
use Illuminate\Support\Str;

class TestimonioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $titulos = Titulo::where('idUsuario', auth()->user()->id)->first();
        $testimonios = Testimonio::where('idUsuario', auth()->user()->id)->orderBy('orden', 'asc')->get();
        return view('intranet.pages.empresa.web.testimonios.index')->with(compact('titulos','testimonios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('intranet.pages.empresa.web.testimonios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);

        if($request->hasFile("imagen")){

            $imagen = $request->file("imagen");
            $nombreimagen = $imagen->getClientOriginalName().".".$imagen->guessExtension();
            $ruta = public_path("img/testimonios/");

            $imagen->move($ruta,$nombreimagen);
            //copy($imagen->getRealPath(),$ruta.$nombreimagen);

            //$post->imagen = $nombreimagen;            
            
        }

        $slider = Testimonio::create([
            'idUsuario' => auth()->user()->id,
            //'idPerfil' => auth()->user()->idPerfil,
            'codigo' => $request->id,
            'nombre' => $request->nombre,
            'orden' => $request->orden,
            'url' => $request->url,
            'texto' => $request->texto,
            'imagen' => $nombreimagen
        ]);

        return redirect()->route('testimonios.index');
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
        $testimonio = Testimonio::find($id);
        return view('intranet.pages.empresa.web.testimonios.edit')->with(compact('testimonio'));
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
        $testimonio = Testimonio::find($id);
        if($request->hasFile("imagen")){

            $imagen = $request->file("imagen");
            $nombreimagen = $imagen->getClientOriginalName().".".$imagen->guessExtension();
            $ruta = public_path("img/sliders/");

            $imagen->move($ruta,$nombreimagen);
            //copy($imagen->getRealPath(),$ruta.$nombreimagen);

            //$post->imagen = $nombreimagen;            
            
        }else{
            $nombreimagen = $testimonio->imagen;
        }
        $testimonio->codigo = $request->id;
        $testimonio->nombre = $testimonio->nombre;
        $testimonio->orden = $request->orden;
        $testimonio->url = $testimonio->url;
        $testimonio->texto = $request->texto;
        $testimonio->imagen = $nombreimagen;
        $testimonio->save();

        return redirect()->route('testimonios.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $testimonio = Testimonio::find($id);
        $testimonio->delete();
        return back();
    }
}
