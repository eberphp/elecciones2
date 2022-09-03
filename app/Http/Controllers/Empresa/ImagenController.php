<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Imagen;
use App\Models\Publicacion;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImagenController extends Controller
{
    public function index($id){
        $imagenes = Imagen::where('pubicacion_id', $id)->get();
        $publicacion = Publicacion::find($id);
        return view('intranet.pages.empresa.web.publicaciones.galeria')->with(compact('imagenes','publicacion'));
    }

    public function store(Request $request){
        if($request->hasFile("imagen")){

            $imagen = $request->file("imagen");
            
            $nombreimagen = Str::slug($imagen->getClientOriginalName() . microtime()) . "." . $imagen->guessExtension();
            $rutasave = "public/img/publicaciones/galeria";
            $path = Storage::putFileAs($rutasave, $imagen, $nombreimagen);
            //copy($imagen->getRealPath(),$ruta.$nombreimagen);

            //$post->imagen = $nombreimagen;

        }
        $imagen = Imagen::create([
            'pubicacion_id' => $request->pubicacion_id,
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
