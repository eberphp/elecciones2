<?php

namespace App\Http\Controllers\Empresa;

use App\Models\Encuestas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Eleccion;
use App\Models\EleccionesVoto;
use App\Models\Votos;


class EleccionesController extends Controller
{
    public function index(Request $request)
    {
        $dts = Eleccion::select("*")
            ->where('estado', '!=', 'Eliminado')->where('datos_empresa_id', idEmpresa())->orderBy('id', 'desc')->get();
        return view('intranet.pages.empresa.elecciones.crear_elecciones', [
            'elecciones' => $dts,
        ]);
    }

    public function encuestador(Request $request)
    {
        $dts = Encuestas::select('*')
            ->where('estado', '!=', 'Eliminado')->orderBy('id', 'desc')->get();

        return view('intranet.pages.empresa.elecciones.encuestador', [
            'encuestas' => $dts,
        ]);
    }


    public function store(Request $request)
    {
        $valiData = $request->validate([
            'nombre' => 'required',
            'inicio' => 'required|date',
            'termino' => 'required|date'
        ]);

        $req = Eleccion::create([
            'nombre' => $valiData['nombre'],
            'datos_empresa_id' => idEmpresa(),
            'fecha_inicio' => $valiData['inicio'],
            'fecha_termino' => $valiData['termino'],
            'encuesta_manual' => "Si",
            'estado' =>"Activo",
            'observaciones' => $request->observacion?$request->observacion:""
        ]);

        if ($req) {
            return to_route('elecciones')->with('success', 'Registrado Correctamente');
        } else {
            return to_route('elecciones')->with('fail', 'Sucedio un error. Vuelva a intentarlo');
        }
    }

    public function show(Request $request, Eleccion $eleccion)
    {
        if ($eleccion) {
            return response()->json([
                'status' => true,
                'message' => 'Encuesta encontrada',
                'data' => $eleccion,
            ], 200);
        }

        return response()->json([
            'status' => false,
            'message' => 'No se encontro la encuesta.',
        ], 402);
    }

    public function update(Request $request, Eleccion $eleccion)
    {
        $valiData = $request->validate([
            'nombre' => 'required',
            'inicio' => 'required|date',
            'termino' => 'required|date',
            'observacion' => 'min:0',
        ]);

        $votos = EleccionesVoto::where('eleccion_id',$eleccion->id)->where('tipo_voto','Manual')->where('estado','Activo')->get();

        if($votos){

            $req = $eleccion->update([
                'nombre' => $valiData['nombre'],
                'fecha_inicio' => $valiData['inicio'],
                'fecha_termino' => $valiData['termino'],
                'estado' => isset($request->estado)?$request->estado:$eleccion->estado,
                'observaciones' => $valiData['observacion']
            ]);
            return to_route('elecciones')->with('fail', 'Ya no puedes Cambiar encuesta Manual por tener Votos Manuales');
        }else{
            $req = $eleccion->update([
                'nombre' => $valiData['nombre'],
                'fecha_inicio' => $valiData['inicio'],
                'fecha_termino' => $valiData['termino'],
                'estado' => isset($request->estado)?$request->estado:$eleccion->estado,
                'observaciones' => $valiData['observacion']
            ]);

            if ($req) {
                return to_route('elecciones')->with('success', 'Actualizado Correctamente');
            } else {
                return to_route('elecciones')->with('fail', 'Sucedio un error. Vuelva a intentarlo');
            }
        }

    }

    public function destroy(Request $request, Eleccion $eleccion)
    {
        $votos = EleccionesVoto::where('eleccion_id',$eleccion->id)->where('estado','Activo')->get();


        if(count($votos)){
            return response()->json([
                'status' => false,
                'message' => 'No puedes Eliminar esta encuesta por te votos asociados.'
            ], 402);
        }else{
            if ($eleccion) {
                $req = $eleccion->update([
                    'estado' => 'Eliminado',
                ]);
                if ($req) {
                    return response()->json([
                        'status' => true,
                        'message' => 'Encuesta Eliminado'
                    ], 200);
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => 'Sucedio un error. Vuelva a intentarlo'
                    ], 402);
                }
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Sucedio un error. Vuelva a intentarlo'
                ], 402);
            }
        }


    }

    public function publicacion(Request $request, Eleccion $eleccion)
    {
        if ($eleccion) {
            $eleccion->publicacion = ($eleccion->publicacion == 'Si') ? 'No' : 'Si';
            $eleccion->save();
            return response()->json([
                'status' => true,
                'message' => 'Eleccion Publicada Satisfactoriamente.',
                "eleccion" => $eleccion
            ], 200);
        }
        return response()->json([
            'status' => true,
            'message' => 'Sucedio un error. Vuelva a intentarlo'
        ], 402);
    }

    public function sumatoria(Request $request, Eleccion $eleccion)
    {
        if ($eleccion) {
            $eleccion->update([
                'dispositivo' => isset($request['dispositivo'])?$request["dispositivo"]:$eleccion->dispositivo,
                'encuestador' => isset($request['encuestador'])?$request["encuestador"]:$eleccion->encuestador,
                'manual' => isset($request['manual'])?$request["manual"]:$eleccion->manual,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Encuesta Publicada Satisfactoriamente.'
            ], 200);
        }

        return response()->json([
            'status' => true,
            'message' => 'Sucedio un error. Vuelva a intentarlo'
        ], 402);
    }
}
