<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use App\Models\Publicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PublicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $publicaciones = Publicacion::where('datos_empresa_id', idEmpresa())->orderBy('orden', 'asc')->get();
        return view('intranet.pages.empresa.web.publicaciones.index')->with(compact('publicaciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('intranet.pages.empresa.web.publicaciones.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->hasFile("imagen")){

            $imagen = $request->file("imagen");



            $nombreimagen = Str::slug($imagen->getClientOriginalName() . microtime()) . "." . $imagen->guessExtension();
            $rutasave = "img/publicaciones/";
            $path = Storage::putFileAs($rutasave, $imagen, $nombreimagen);
            //copy($imagen->getRealPath(),$ruta.$nombreimagen);

            //$post->imagen = $nombreimagen;

        }else{
            $nombreimagen = null;
        }

        $publicacion = Publicacion::create([
            'datos_empresa_id' => idEmpresa(),
            'codigo' => $request->id,
            'nombre' => $request->nombre,
            'orden' => $request->orden,
            'url' => $request->url,
            'texto' => $request->texto,
            'idConfiguracion' => $request->idConfiguracion,
            'numOrdenador' => $request->ordenador,
            'numTablet' => $request->tablet,
            'numCelular' => $request->celular,
            'modeloBloque' => $request->modelo,
            'selecciona' => $request->selecciona,
            'imagen' => $nombreimagen,
            'linkVideo' => $request->video
        ]);

        return redirect()->route('publicaciones.index');
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
        $publicacion = Publicacion::find($id);
        return view('intranet.pages.empresa.web.publicaciones.edit')->with(compact('publicacion'));
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
        $publicacion = Publicacion::find($id);
        if($request->hasFile("imagen")){

            $imagen = $request->file("imagen");
            $nombreimagen = Str::slug($imagen->getClientOriginalName() . microtime()) . "." . $imagen->guessExtension();
            $rutasave = "img/publicaciones/";
            $path = Storage::putFileAs($rutasave, $imagen, $nombreimagen);
            //copy($imagen->getRealPath(),$ruta.$nombreimagen);

            //$post->imagen = $nombreimagen;

        }else{
            $nombreimagen = $publicacion->imagen;
        }
        $publicacion->codigo = $request->id;
        $publicacion->nombre = $request->nombre;
        $publicacion->orden = $request->orden;
        $publicacion->url = $request->url;
        $publicacion->texto = $request->texto;
        $publicacion->idConfiguracion = $request->idConfiguracion;
        $publicacion->modeloBloque = $request->modelo;
        $publicacion->selecciona = $request->selecciona;
        $publicacion->imagen = $nombreimagen;
        $publicacion->linkVideo = $request->video;
        $publicacion->save();

        return redirect()->route('publicaciones.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $publicacion = Publicacion::find($id);
        $publicacion->delete();

        return back();
    }
}
