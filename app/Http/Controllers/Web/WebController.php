<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DatosEmpresa;
use App\Models\RedesSociales;
use App\Models\Slider;
use App\Models\Boton;
use App\Models\Publicacion;
use App\Models\Servicio;
use App\Models\Subpublicacion;
use App\Models\Testimonio;
use App\Models\Titulo;

class WebController extends Controller
{
    //
    public function index()
    {
        $id = idEmpresa();
        dd($id);
        $publicaciones = Publicacion::where('datos_empresa_id', $id)->orderBy('orden', 'asc')->get();
        //dd($publicaciones[0]->modeloBloque == 'Bloque 1');
        $servicios = Servicio::where('datos_empresa_id', $id)->orderBy('nombre', 'asc')->get();
        $botones = Boton::where('datos_empresa_id', $id)->orderBy('orden', 'asc')->get();
        $datos = DatosEmpresa::where('id', $id)->first();
        //contador
        $contador  = $datos->visitas;
        $contador = $contador+1;
        $datos->visitas = $contador;
        $datos->save();
        //fin contador
        $redes = RedesSociales::where('datos_empresa_id', $id)->first();
        $sliders = Slider::where('datos_empresa_id', $id)->orderBy('orden', 'asc')->get();
        $testimonios = Testimonio::where('datos_empresa_id', $id)->orderBy('orden', 'asc')->get();
        $titulo = Titulo::where('datos_empresa_id', $id)->first();
        return view('web.pages.index')->with(compact('datos', 'redes', 'sliders', 'botones', 'servicios', 'publicaciones', 'testimonios', 'titulo'));
    }

    public function subpublicaciones($id, $pubicacion_id)
    {
        //dd($pubicacion_id);
        $subpublicaciones = Subpublicacion::where('pubicacion_id', $pubicacion_id)->orderBy('orden', 'asc')->get();
        //dd($publicaciones[0]->modeloBloque == 'Bloque 1');
        $servicios = Servicio::where('datos_empresa_id', $id)->orderBy('nombre', 'asc')->get();
        $botones = Boton::where('datos_empresa_id', $id)->orderBy('orden', 'asc')->get();
        $datos = DatosEmpresa::where('id', $id)->first();
        $redes = RedesSociales::where('datos_empresa_id', $id)->first();
        $sliders = Slider::where('datos_empresa_id', $id)->orderBy('orden', 'asc')->get();
        $titulo = Titulo::where('datos_empresa_id', $id)->first();
        return view('web.pages.subpublicaciones')->with(compact('datos', 'redes', 'sliders', 'botones', 'servicios', 'subpublicaciones', 'titulo'));
    }

    public function nosotros()
    {
        $id = idEmpresa();
        $publicaciones = Publicacion::where('datos_empresa_id', $id)->orderBy('orden', 'asc')->get();
        //dd($publicaciones[0]->modeloBloque == 'Bloque 1');
        $servicios = Servicio::where('datos_empresa_id', $id)->orderBy('nombre', 'asc')->get();
        $botones = Boton::where('datos_empresa_id', $id)->orderBy('orden', 'asc')->get();
        $datos = DatosEmpresa::where('id', $id)->first();
        $redes = RedesSociales::where('datos_empresa_id', $id)->first();
        $sliders = Slider::where('datos_empresa_id', $id)->orderBy('orden', 'asc')->get();
        $testimonios = Testimonio::where('datos_empresa_id', $id)->orderBy('orden', 'asc')->get();
        $titulo = Titulo::where('datos_empresa_id', $id)->first();
        return view('web.pages.nosotros')->with(compact('datos', 'redes', 'sliders', 'botones', 'servicios', 'publicaciones', 'testimonios', 'titulo'));
    }

}
