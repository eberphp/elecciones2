<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use App\Models\DatosEmpresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DatosController extends Controller
{
    public function index()
    {
        $datos = null;
        if (auth()->user()->personal) {
            $datos = DatosEmpresa::find(auth()->user()->personal->empresa_id);
        } else {
            $datos = DatosEmpresa::where('id', idEmpresa())->first();
        }

        return view('intranet.pages.empresa.web.datos-empresa')->with(compact('datos'));
    }

    public function update(Request $request, $id)
    {
        //dd($request->file ("bannerPrincipal"));
        $datos = DatosEmpresa::find($id);

        if ($request->file("favicon")) {
            $imagen = $request->file("favicon");
            $nombreimagenFavicon = Str::slug($imagen->getClientOriginalName() . microtime()) . "." . $imagen->guessExtension();
            $rutasave = "public/img/favicon/";
            $path = Storage::disck('public')->putFileAs($rutasave, $imagen, $nombreimagenFavicon);
        } else {
            $nombreimagenFavicon = $datos->favicon;
        }

        if ($request->file("bannerPrincipal")) {
            $imagen = $request->file("bannerPrincipal");
            $nombreimagenBanner = Str::slug($imagen->getClientOriginalName() . microtime()) . "." . $imagen->guessExtension();
            $rutasave = "public/img/bannerPrincipal/";
            $path = Storage::putFileAs($rutasave, $imagen, $nombreimagenBanner);
            //copy($imagen->getRealPath(),$ruta.$nombreimagen);

            //$post->imagen = $nombreimagen;

        } else {
            $nombreimagenBanner = $datos->bannerPrincipal;
        }


        $datos->nombre = $request->nombre;
        $datos->favicon = $nombreimagenFavicon; //$request->favicon;
        $datos->bannerPrincipal = $nombreimagenBanner; //$request->bannerPrincipal;
        $datos->telefono1 = $request->telefono1;
        $datos->telefono2 = $request->telefono2;
        $datos->correo = $request->correo;
        $datos->piePagina = $request->piePagina;
        $datos->terminoCondiciones = $request->terminoCondiciones;
        $datos->nosotros = $request->nosotros;
        $datos->derechos = $request->derechos;
        $datos->save();

        return back();
    }
}
