<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\MenuFormRequest;
use App\Models\Encuesta;
use Illuminate\Http\Request;
use Exception;

class ApiEncuestaController extends Controller
{
    public $componentName;

    public function __construct()
    {
        $this->componentName = 'Menu';
    }

    public function index(Request $request)
    {
            $encuesta = Encuesta::orderByDesc('idEncuesta')->get();
            return $encuesta;  
    }
    // public function create()
    // {
    //     $estados = ['PAGADO', 'EN DEUDA'];
    //     return view('configuracion.menu.create',  ["estados" => $estados]);
    // }
    public function store(Request $request)
    {
        try {
           
            $encuesta = new Encuesta();
            $encuesta->idperiodo = $request->get('idperiodo');
            $encuesta->idCandidatoDepartamento = $request->get('idCandidatoDepartamento'); 
            $encuesta->idDepartamento = $request->get('idDepartamento');
            $encuesta->idCandidatoProvincia = $request->get('idCandidatoProvincia'); 
            $encuesta->idProvincia = $request->get('idProvincia');
            $encuesta->idCandidatoDistrito = $request->get('idCandidatoDistrito'); 
            $encuesta->idDistrito = $request->get('idDistrito');
            $encuesta->idZona = $request->get('idZona'); 
            $encuesta->VotoDistrital = intval($request->get('VotoDistrital'));
            $encuesta->VotoDepartamento = intval($request->get('VotoDepartamento'));
            $encuesta->VotoProvincial = intval($request->get('VotoProvincial'));
            $encuesta->save();
            
        } catch (Exception $e) {
            return  response()->json($e);
        }
        return \response($encuesta);
    }

    // public function edit($id)
    // {
    //     $estados = [0, 1];
    //     return view("configuracion.menu.edit", ["menu" => Menu::findOrFail($id), "estados" => $estados, "componentName" => $this->componentName]);
    // }
    public function update(Request $request, $id)
    {
        try {
        
            $encuesta = Encuesta::findOrFail($id);
            $encuesta->idperiodo = $request->get('idperiodo');
            $encuesta->idCandidatoDepartamento = $request->get('idCandidatoDepartamento'); 
            $encuesta->idDepartamento = $request->get('idDepartamento');
            $encuesta->idCandidatoProvincia = $request->get('idCandidatoProvincia'); 
            $encuesta->idProvincia = $request->get('idProvincia');
            $encuesta->idCandidatoDistrito = $request->get('idCandidatoDistrito'); 
            $encuesta->idDistrito = $request->get('idDistrito');
            $encuesta->idZona = $request->get('idZona'); 
            $encuesta->VotoDistrital = intval($request->get('VotoDistrital'));
            $encuesta->VotoDepartamento = intval($request->get('VotoDepartamento'));
            $encuesta->VotoProvincial = intval($request->get('VotoProvincial'));
            $encuesta->update();

        } catch (Exception $e) {
            return  response()->json($e);
        }
        return \response($encuesta);
    }

    public function destroy(Request $request, $id)
    {
        $encuesta = Encuesta::findOrFail($id);
        $encuesta->delete();
        return \response(content: "el registro de id : $id fue elimindado");
    }
}
