<?php

namespace App\Http\Controllers\Empresa;

use App\Models\Encuestas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Votos;


class EleccionesController extends Controller
{
    public function index(Request $request)
    {
        $dts = Encuestas::select('idEncuesta', 'nombreEncuesta', 'fechaInicio', 'fechaTermino', 'observaciones', 'encuestaManual', 'estado')
            ->where('estado', '!=', 'Eliminado')->where('datos_empresa_id', idEmpresa())->orderBy('idEncuesta', 'desc')->get();

        return view('intranet.pages.empresa.elecciones.crear_encuestas', [
            'encuestas' => $dts,
        ]);
    }

    public function encuestador(Request $request)
    {
        $dts = Encuestas::select('idEncuesta', 'nombreEncuesta', 'fechaInicio', 'fechaTermino', 'observaciones', 'encuestaManual', 'estado')
            ->where('estado', '!=', 'Eliminado')->orderBy('idEncuesta', 'desc')->get();

        return view('intranet.pages.empresa.elecciones.encuestador', [
            'encuestas' => $dts,
        ]);
    }


    public function store(Request $request)
    {
        $valiData = $request->validate([
            'nombre' => 'required',
            'inicio' => 'required|date',
            'termino' => 'required|date',
            'encuesta' => 'required|string',
            'estado' => 'string',
            'observacion' => 'min:0',
        ]);

        $req = Encuestas::create([
            'nombreEncuesta' => $valiData['nombre'],
            'datos_empresa_id' => idEmpresa(),
            'fechaInicio' => $valiData['inicio'],
            'fechaTermino' => $valiData['termino'],
            'encuestaManual' => $valiData['encuesta'],
            'estado' => $valiData['estado'],
            'observaciones' => $valiData['observacion']
        ]);

        if ($req) {
            return to_route('Encuesta')->with('success', 'Registrado Correctamente');
        } else {
            return to_route('Encuesta')->with('fail', 'Sucedio un error. Vuelva a intentarlo');
        }
    }

    public function show(Request $request, Encuestas $encuesta)
    {
        if ($encuesta) {
            return response()->json([
                'status' => true,
                'message' => 'Encuesta encontrada',
                'data' => $encuesta,
            ], 200);
        }

        return response()->json([
            'status' => false,
            'message' => 'No se encontro la encuesta.',
        ], 402);
    }

    public function update(Request $request, Encuestas $encuesta)
    {
        $valiData = $request->validate([
            'nombre' => 'required',
            'inicio' => 'required|date',
            'termino' => 'required|date',
            'encuesta' => 'required|string',
            'estado' => 'string',
            'observacion' => 'min:0',
        ]);

        $votos = Votos::where('encuestaId',$encuesta->idEncuesta)->where('tipoEncuesta','Manual')->where('estado','Activo')->get();

        if($votos){

            $req = $encuesta->update([
                'nombreEncuesta' => $valiData['nombre'],
                'fechaInicio' => $valiData['inicio'],
                'fechaTermino' => $valiData['termino'],
                'estado' => $valiData['estado'],
                'observaciones' => $valiData['observacion']
            ]);

            return to_route('Encuesta')->with('fail', 'Ya no puedes Cambiar encuesta Manual por tener Votos Manuales');
        }else{
            $req = $encuesta->update([
                'nombreEncuesta' => $valiData['nombre'],
                'fechaInicio' => $valiData['inicio'],
                'fechaTermino' => $valiData['termino'],
                'encuestaManual' => $valiData['encuesta'],
                'estado' => $valiData['estado'],
                'observaciones' => $valiData['observacion']
            ]);

            if ($req) {
                return to_route('Encuesta')->with('success', 'Actualizado Correctamente');
            } else {
                return to_route('Encuesta')->with('fail', 'Sucedio un error. Vuelva a intentarlo');
            }
        }

    }

    public function destroy(Request $request, Encuestas $encuesta)
    {
        $votos = Votos::where('encuestaId',$encuesta->idEncuesta)->where('estado','Activo')->get();

        if($votos){
            return response()->json([
                'status' => false,
                'message' => 'No puedes Eliminar esta encuesta por te votos asociados.'
            ], 402);
        }else{
            if ($encuesta) {

                $req = $encuesta->update([
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

    public function publicacion(Request $request, Encuestas $encuesta)
    {
        if ($encuesta) {
            $encuesta->update([
                'publicacion' => ($encuesta->publicacion == 'Si') ? 'No' : 'Si',
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

    public function sumatoria(Request $request, Encuestas $encuesta)
    {
        if ($encuesta) {
            $encuesta->update([
                'dispositivo' => $request['dispositivo'],
                'encuestador' => $request['encuestador'],
                'manual' => $request['manual'],
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
