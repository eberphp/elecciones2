<?php

namespace App\Http\Controllers\Empresa;

use App\Models\User;
use App\Models\Proyecto;
use Illuminate\Http\Request;
use App\Models\EstadoActividad;
use App\Http\Controllers\Controller;
use App\Models\Cargo;
use App\Models\Entregables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ProyectoController extends Controller
{
    public function index(Request $request)
    {
        $proyectos = Proyecto::with('encargados:id,email')->with('responsables:id,email')->where('estado','Activo')->get();

        $estadoActividades = EstadoActividad::where('estado','activo')->get();
        $responsables = User::all();
        // dd($proyectos);
        return view('intranet.pages.empresa.proyectos.index',[
            'proyectos' => $proyectos,
            'responsables' => $responsables,
            'estados' => $estadoActividades,
        ]);
    }

    public function store(Request $request)
    {
        $valiData = $request->validate([
            'nombre' => 'required',
            'inicio' => '',
            'dias' => '',
            'responsable' => 'required|string',
            'costo' => '',
            'estado' => 'required|string',
            'observacion' => 'min:0',
        ]);

        $req = Proyecto::create([
            'nombre' => $valiData['nombre'],
            'fechaInicio' => $valiData['inicio'],
            'diasVencidos' => 0,
            'plazo' => $valiData['dias'],
            'totalEntregables' => 0,
            'encargado' => Auth::user()->id,
            'responsable' => $valiData['responsable'],
            'costo' => $valiData['costo'],
            'estadoActivida' => $valiData['estado'],
            'observaciones' => $valiData['observacion']
        ]);

        if ($req) {
            return to_route('Proyecto')->with('success', 'Registrado Correctamente');
        } else {
            return to_route('Proyecto')->with('fail', 'Sucedio un error. Vuelva a intentarlo');
        }
    }

    public function show(Request $request, Proyecto $proyecto)
    {
        if ($proyecto) {
            $proyecto['date'] = Carbon::parse($proyecto->fechaInicio)->format('Y-m-d H:i:s');
            if($proyecto->plazo){
                $proyecto['plazoDias'] = Carbon::parse($proyecto->plazo)->format('Y-m-d H:i:s');
            }
            return response()->json([
                'status' => true,
                'message' => 'Proyecto encontrada',
                'data' => $proyecto,
            ], 200);
        }

        return response()->json([
            'status' => false,
            'message' => 'No se encontro el Proyecto.',
        ], 402);
    }

    public function update(Request $request, Proyecto $proyecto)
    {
        $valiData = $request->validate([
            'nombre' => 'required',
            'inicio' => '',
            'dias' => '',
            'responsable' => 'required|string',
            'costo' => '',
            'estado' => 'required|string',
            'observacion' => 'min:0',
        ]);

        $req = $proyecto->update([
            'nombre' => $valiData['nombre'],
            'fechaInicio' => $valiData['inicio'],
            'plazo' => $valiData['dias'],
            'responsable' => $valiData['responsable'],
            'costo' => $valiData['costo'],
            'estadoActivida' => $valiData['estado'],
            'observaciones' => $valiData['observacion']
        ]);

        if ($req) {
            return to_route('Proyecto')->with('success', 'Actualizado Correctamente');
        } else {
            return to_route('Proyecto')->with('fail', 'Sucedio un error. Vuelva a intentarlo');
        }

    }

    public function destroy(Request $request, Proyecto $proyecto)
    {
        $entregables = Entregables::where('proyectoId',$proyecto->idProyecto)->where('estado','Activo')->get();
        // dd($entregables->isEmpty());

        if(!$entregables->isEmpty()){
            return response()->json([
                'status' => false,
                'message' => 'No puedes Eliminar este Proyecto por tener Entregables.'
            ], 402);
        }else{
            if ($proyecto) {

                $req = $proyecto->update([
                    'estado' => 'Eliminado',
                ]);

                if ($req) {
                    return response()->json([
                        'status' => true,
                        'message' => 'Proyecto Eliminado'
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

}
