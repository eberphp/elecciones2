<?php

namespace App\Http\Controllers\Empresa;

use App\Models\Encuestas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EncuestaController extends Controller
{
    public function index(Request $request)
    {
        $dts = Encuestas::select('idEncuesta', 'nombreEncuesta', 'fechaInicio', 'fechaTermino', 'observaciones', 'encuestaManual', 'estado')
            ->where('estado', '!=', 'Eliminado')->orderBy('idEncuesta', 'desc')->get();

        return view('intranet.pages.empresa.encuestas.crear_encuestas', [
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

    public function destroy(Request $request, Encuestas $encuesta)
    {
        if ($encuesta) {
            $req = $encuesta->update([
                'estado' => 'Eliminado',
            ]);

            if ($req) {
               return response()->json([
                'status' => true,
                'message' => 'Encuesta Eliminado'
               ],200);
            } else {
                return response()->json([
                'status' => true,
                'message' => 'Sucedio un error. Vuelva a intentarlo'
               ],402);
            }
        } else {
            return response()->json([
                'status' => true,
                'message' => 'Sucedio un error. Vuelva a intentarlo'
               ],402);
        }
    }
}
