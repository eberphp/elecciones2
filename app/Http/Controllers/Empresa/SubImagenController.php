<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubImagen;
use App\Models\Subpublicacion;

class SubImagenController extends Controller
{
    public function index($id){
        $imagenes = SubImagen::where('idSubpublicacion', $id)->get();
        $subpublicacion = Subpublicacion::find($id);
        //dd($subpublicacion);
        return view('intranet.pages.empresa.web.subpublicaciones.galeria')->with(compact('imagenes','subpublicacion'));
    }

    public function store(Request $request){
        if($request->hasFile("imagen")){

            $imagen = $request->file("imagen");
            $nombreimagen = $imagen->getClientOriginalName().".".$imagen->guessExtension();
            $ruta = public_path("img/subpublicaciones/galeria/");

            $imagen->move($ruta,$nombreimagen);
            //copy($imagen->getRealPath(),$ruta.$nombreimagen);

            //$post->imagen = $nombreimagen;            
            
        }
        $imagen = SubImagen::create([
            'idSubpublicacion' => $request->idSubpublicacion,
            'imagen' => $nombreimagen,
        ]);

        return back();
    }

    public function update(Request $request, $id){

    }

    public function destroy($id){
        $imagen = SubImagen::find($id);
        $imagen->delete();

        return back();
    }
}
