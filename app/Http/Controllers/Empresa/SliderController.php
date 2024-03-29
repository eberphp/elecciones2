<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::where('datos_empresa_id', idEmpresa())->orderBy('orden', 'asc')->get();
        //dd($sliders);
        return view('intranet.pages.empresa.web.sliders.index')->with(compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('intranet.pages.empresa.web.sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);

        if ($request->hasFile("imagen")) {
            $imagen = $request->file("imagen");
            $nombreimagen = Str::slug($request->nombre) . Str::slug(microtime() . "") . "." . $imagen->guessExtension();
            $rutasave = "img/sliders/";
            $path = Storage::putFileAs($rutasave, $imagen, $nombreimagen);
        } else {
            $nombreimagen = null;
        }

        $slider = Slider::create([
            'datos_empresa_id' => idEmpresa(),
            'perfil_id' => auth()->user()->perfil_id,
            'codigo' => $request->id,
            'nombre' => $request->nombre,
            'orden' => $request->orden,
            'url' => $request->url,
            'texto' => $request->texto,
            'imagen' => $nombreimagen
        ]);

        return redirect()->route('sliders.index');
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
        $slider = Slider::find($id);
        return view('intranet.pages.empresa.web.sliders.edit')->with(compact('slider'));
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
        $slider = Slider::find($id);
        if ($request->hasFile("imagen")) {

            $imagen = $request->file("imagen");
            $nombreimagen = Str::slug($imagen->getClientOriginalName() . microtime()) . "." . $imagen->guessExtension();
            $rutasave = "public/img/sliders/";
            $path = Storage::putFileAs($rutasave, $imagen, $nombreimagen);
            //copy($imagen->getRealPath(),$ruta.$nombreimagen);

            //$post->imagen = $nombreimagen;

        } else {
            $nombreimagen = $slider->imagen;
        }


        $slider->codigo = $request->id;
        $slider->nombre = $request->nombre;
        $slider->orden = $request->orden;
        $slider->url = $request->url;
        $slider->texto = $request->texto;
        $slider->imagen = $nombreimagen;
        $slider->save();

        return redirect()->route('sliders.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = Slider::find($id);
        $slider->delete();

        return back();
    }
}
