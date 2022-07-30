<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RedesSociales;

class RedesSocialesController extends Controller
{
    public function index(){
        $redes = RedesSociales::where('idUsuario', auth()->user()->id)->first();
        return view('intranet.pages.empresa.web.redes-sociales')->with(compact('redes'));
    }

    public function update(Request $request, $id){

        //dd($request);

        $social = RedesSociales::find($id);
        $social->facebook = $request->facebook;
        $social->twitter = $request->twitter;
        $social->instagram = $request->instagram;
        $social->linkedin = $request->linkedin;
        $social->whatsapp = $request->whatsapp;
        $social->colorFondo = $request->colorFondo;
        $social->save();

        return redirect()->route('redes.empresa');
    }
}
