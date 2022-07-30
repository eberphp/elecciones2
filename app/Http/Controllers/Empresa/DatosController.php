<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use App\Models\DatosEmpresa;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DatosController extends Controller
{
    public function index(){
        $datos = DatosEmpresa::where('idUsuario', auth()->user()->id)->first();
        return view('intranet.pages.empresa.web.datos-empresa')->with(compact('datos'));
    }

    public function update(Request $request, $id){
        
        $datos = DatosEmpresa::find($id);
        
        if($request->hasFile("favicon")){

            $imagen = $request->file("favicon");
            $nombreimagenFavicon = $imagen->getClientOriginalName().".".$imagen->guessExtension();
            $ruta = public_path("img/favicon/");
            
            $imagen->move($ruta,$nombreimagenFavicon);
            //copy($imagen->getRealPath(),$ruta.$nombreimagen);

            //$post->imagen = $nombreimagen;            
            
        }else{
            $nombreimagenFavicon = $datos->favicon;
        }

        if($request->hasFile("bannerPrincipal")){

            $imagen = $request->file("bannerPrincipal");
            $nombreimagenBanner = $imagen->getClientOriginalName().".".$imagen->guessExtension();
            $ruta = public_path("img/bannerPrincipal/");

            $imagen->move($ruta,$nombreimagenBanner);
            //copy($imagen->getRealPath(),$ruta.$nombreimagen);

            //$post->imagen = $nombreimagen;            
            
        }else{
            $nombreimagenBanner = $datos->bannerPrincipal;
        }

        
        $datos->nombre = $request->nombre;
        $datos->favicon = $nombreimagenFavicon;//$request->favicon;
        $datos->bannerPrincipal = $nombreimagenBanner;//$request->bannerPrincipal;
        $datos->telefono1 = $request->telefono1;
        $datos->telefono2 = $request->telefono2;
        $datos->correo = $request->correo;
        $datos->piePagina = $request->piePagina;
        $datos->terminoCondiciones = $request->terminoCondiciones;
        $datos->derechos = $request->derechos;
        $datos->save();

        return back();
    }
}
