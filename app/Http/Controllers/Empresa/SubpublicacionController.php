<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use App\Models\Publicacion;
use Illuminate\Http\Request;
use App\Models\Subpublicacion;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SubpublicacionController extends Controller
{
    public function index($id)
    {
        $subpublicaciones = Subpublicacion::where('pubicacion_id', $id)->orderBy('orden', 'asc')->get();
        $publicacion = Publicacion::find($id);
        return view('intranet.pages.empresa.web.subpublicaciones.index')->with(compact('subpublicaciones', 'publicacion'));
    }

    public function create($id)
    {
        $publicacion = Publicacion::find($id);
        return view('intranet.pages.empresa.web.subpublicaciones.create')->with(compact('publicacion'));
    }

    public function store(Request $request)
    {
        //dd($request);
        if ($request->hasFile("imagen")) {
            $imagen = $request->file("imagen");
            $nombreimagen = Str::slug($imagen->getClientOriginalName() . microtime()) . "." . $imagen->guessExtension();
            $rutasave = "img/subpublicaciones/";
            $path = Storage::putFileAs($rutasave, $imagen, $nombreimagen);
            //copy($imagen->getRealPath(),$ruta.$nombreimagen);
            //$post->imagen = $nombreimagen;
        } else {
            $nombreimagen = null;
        }

        $subpublicacion = Subpublicacion::create([
            'datos_empresa_id' => idEmpresa(),
            'pubicacion_id' => $request->pubicacion_id,
            'codigo' => $request->id,
            'nombre' => $request->nombre,
            'orden' => $request->orden,
            'url' => $request->url,
            'texto' => $request->texto,
            'idConfiguracion' => $request->idConfiguracion,
            'modeloBloque' => $request->modelo,
            'selecciona' => $request->selecciona,
            'imagen' => $nombreimagen,
            'linkVideo' => $request->video
        ]);

        return redirect()->route('subpublicaciones.index', $request->pubicacion_id);
    }

    public function edit($id)
    {
        $subpublicacion = Subpublicacion::find($id);
        return view('intranet.pages.empresa.web.subpublicaciones.edit')->with(compact('subpublicacion'));
    }

    public function update(Request $request, $id)
    {
        $subpublicacion = Subpublicacion::find($id);
        if ($request->hasFile("imagen")) {

            $imagen = $request->file("imagen");
            $nombreimagen = Str::slug($imagen->getClientOriginalName() . microtime()) . "." . $imagen->guessExtension();
            $rutasave = "img/subpublicaciones/";
            $path = Storage::putFileAs($rutasave, $imagen, $nombreimagen);
            //copy($imagen->getRealPath(),$ruta.$nombreimagen);

            //$post->imagen = $nombreimagen;

        } else {
            $nombreimagen = $subpublicacion->imagen;
        }
        $subpublicacion->codigo = $request->id;
        $subpublicacion->nombre = $request->nombre;
        $subpublicacion->orden = $request->orden;
        $subpublicacion->url = $request->url;
        $subpublicacion->texto = $request->texto;
        $subpublicacion->idConfiguracion = $request->idConfiguracion;
        $subpublicacion->modeloBloque = $request->modelo;
        $subpublicacion->selecciona = $request->selecciona;
        $subpublicacion->imagen = $nombreimagen;
        $subpublicacion->linkVideo = $request->video;
        $subpublicacion->save();

        return redirect()->route('subpublicaciones.index', $subpublicacion->pubicacion_id);
    }

    public function destroy($id)
    {
        $subpublicacion = Subpublicacion::find($id);
        $subpublicacion->delete();
        return back();
    }
}
