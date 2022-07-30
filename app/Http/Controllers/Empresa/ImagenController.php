<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Imagen;
use App\Models\Publicacion;
use Illuminate\Support\Str;

class ImagenController extends Controller
{
    public function index($id){
        $imagenes = Imagen::where('idPublicacion', $id)->get();
        $publicacion = Publicacion::find($id);
        return view('intranet.pages.empresa.web.publicaciones.galeria')->with(compact('imagenes','publicacion'));
    }

    public function store(Request $request){
        if($request->hasFile("imagen")){

            $imagen = $request->file("imagen");
            $nombreimagen = $imagen->getClientOriginalName().".".$imagen->guessExtension();
            $ruta = public_path("img/publicaciones/galeria");

            $imagen->move($ruta,$nombreimagen);
            //copy($imagen->getRealPath(),$ruta.$nombreimagen);

            //$post->imagen = $nombreimagen;            
            
        }
        $imagen = Imagen::create([
            'idPublicacion' => $request->idPublicacion,
            'imagen' => $nombreimagen,
        ]);

        return back();
    }
    public function update(Request $request, $id){

    }
    public function destroy($id){
        $imagen = Imagen::find($id);
        $imagen->delete();

        return back();
    }
}
