<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use App\Models\Publicacion;
use Illuminate\Http\Request;
use App\Models\Subpublicacion;
use Illuminate\Support\Str;

class SubpublicacionController extends Controller
{
    public function index($id){
        $subpublicaciones = Subpublicacion::where('idPublicacion',$id)->orderBy('orden', 'asc')->get();
        $publicacion = Publicacion::find($id);
        return view('intranet.pages.empresa.web.subpublicaciones.index')->with(compact('subpublicaciones', 'publicacion'));
    }

    public function create($id){
        $publicacion = Publicacion::find($id);
        return view('intranet.pages.empresa.web.subpublicaciones.create')->with(compact('publicacion'));
    }

    public function store(Request $request){
        //dd($request);
        if($request->hasFile("imagen")){

            $imagen = $request->file("imagen");
            $nombreimagen = $imagen->getClientOriginalName().".".$imagen->guessExtension();
            $ruta = public_path("img/subpublicaciones/");

            $imagen->move($ruta,$nombreimagen);
            //copy($imagen->getRealPath(),$ruta.$nombreimagen);

            //$post->imagen = $nombreimagen;             
            
        }else{
            $nombreimagen = null;
        }

        $subpublicacion = Subpublicacion::create([
            'idUsuario' => auth()->user()->id,
            'idPublicacion' => $request->idPublicacion,
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

        return redirect()->route('subpublicaciones.index', $request->idPublicacion);
    }

    public function edit($id){
        $subpublicacion = Subpublicacion::find($id);
        return view('intranet.pages.empresa.web.subpublicaciones.edit')->with(compact('subpublicacion'));
    }

    public function update(Request $request, $id){
        $subpublicacion = Subpublicacion::find($id);
        if($request->hasFile("imagen")){

            $imagen = $request->file("imagen");
            $nombreimagen = $imagen->getClientOriginalName().".".$imagen->guessExtension();
            $ruta = public_path("img/subpublicaciones/");

            $imagen->move($ruta,$nombreimagen);
            //copy($imagen->getRealPath(),$ruta.$nombreimagen);

            //$post->imagen = $nombreimagen;            
            
        }else{
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

        return redirect()->route('subpublicaciones.index', $subpublicacion->idPublicacion);
    }

    public function destroy($id){
        $subpublicacion = Subpublicacion::find($id);
        $subpublicacion->delete();
        return back();
    }
}
