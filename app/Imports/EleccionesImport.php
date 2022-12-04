<?php

namespace App\Imports;

use App\Models\Departamento;
use App\Models\Distrito;
use App\Models\Eleccion;
use App\Models\EleccionesVoto;
use App\Models\EstadoEvaluacion;
use App\Models\Funcion;
use App\Models\LocalVotacion;
use App\Models\Partido;
use App\Models\Perfil;
use App\Models\Personal;
use App\Models\Provincia;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use DateTime;
use Maatwebsite\Excel\Concerns\ToModel;
use function PHPUnit\Framework\isEmpty;

class EleccionesImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public $usuario_creador;
    public function __construct($usuario_creador)
    {
        $this->usuario_creador = $usuario_creador;
    }


    public function model(array $row)
    {
        $partidos = Partido::all();
        $elecciones = Eleccion::where("datos_empresa_id", idEmpresa())->get();
        $localVotacion = LocalVotacion::where('num_mesa', $row['numero_de_mesa'])->first();
        if(!$localVotacion){
            return null;
        }
        $departamento = Departamento::where('departamento', $localVotacion->departamento)->first();
        if(!$departamento){
            return null;
        }
        $provincia = Provincia::where('provincia', $localVotacion->provincia)->where('idDepartamento', $departamento->id)->first();
        if(!$provincia){
            return null;
        }
        $distrito = Distrito::where('distrito', $localVotacion->distrito)->where('idDepartamento', $departamento->id)->where('idProvincia', $provincia->id)->first();
        if(!$distrito){
            return null;
        }
        if (count($partidos) >= 5 && count($elecciones) >= 1 && $localVotacion&& $departamento && $provincia && $distrito) {
            // volcado para partido 1
            $votoexiste1 = EleccionesVoto::where("eleccion_id", $elecciones[0]->id)
                ->where("partido_id", $partidos[0]->id)
                ->where("mesa_id", $localVotacion->id)
                ->first();

            if (!$votoexiste1) {
                $voto1 = new EleccionesVoto();
                $voto1->eleccion_id = $elecciones[0]->id;
                $voto1->partido_id = $partidos[0]->id;
                $voto1->departamento = $departamento->id;
                $voto1->provincia = $provincia->id;
                $voto1->distrito = $distrito->id;
                $voto1->datos_empresa_id = idEmpresa();
                $voto1->mesa_id = $localVotacion->id;
                $voto1->region = 'Distrital';
                $voto1->votos = $row['gh'];
                $voto1->tipo_voto = 'Manual';
                $voto1->codigo = random_int(100000, 999999);
                $voto1->votos_departamento = $row['gh'];
                $voto1->votos_provincia = $row['gh'];
                $voto1->votos_distrito = $row['gh'];
                $voto1->created_by = $this->usuario_creador;
                $voto1->updated_by = $this->usuario_creador;
                $voto1->fecha = date('Y-m-d');
                $voto1->save();
            } else {

                $votoexiste1->votos_departamento = $row['gh'];
                $votoexiste1->votos_provincia = $row['gh'];
                $votoexiste1->votos_distrito = $row['gh'];
                $votoexiste1->votos = $row['gh'];
                $votoexiste1->updated_by = $this->usuario_creador;
                $votoexiste1->save();
            }


            // volcado para partido 2

            $votoexiste2 = EleccionesVoto::where("eleccion_id", $elecciones[0]->id)
                ->where("partido_id", $partidos[1]->id)
                ->where("mesa_id", $localVotacion->id)
                ->first();

            if (!$votoexiste2) {
                $voto2 = new EleccionesVoto();
                $voto2->eleccion_id = $elecciones[0]->id;
                $voto2->partido_id = $partidos[1]->id;
                $voto2->departamento = $departamento->id;
                $voto2->provincia = $provincia->id;
                $voto2->distrito = $distrito->id;
                $voto2->datos_empresa_id = idEmpresa();
                $voto2->mesa_id = $localVotacion->id;
                $voto2->region = 'Distrital';
                $voto2->votos = $row['va'];
                $voto2->tipo_voto = 'Manual';
                $voto2->codigo = random_int(100000, 999999);
                $voto2->votos_departamento = $row['va'];
                $voto2->votos_provincia = $row['va'];
                $voto2->votos_distrito = $row['va'];
                $voto2->created_by = $this->usuario_creador;
                $voto2->updated_by = $this->usuario_creador;
                $voto2->fecha = date('Y-m-d');
                $voto2->save();
            } else {
                $votoexiste2->votos_departamento = $row['va'];
                $votoexiste2->votos_provincia = $row['va'];
                $votoexiste2->votos_distrito = $row['va'];
                $votoexiste2->votos = $row['va'];
                $votoexiste2->updated_by = $this->usuario_creador;
                $votoexiste2->save();
            }

            // volcado para partido 3

            $votoexiste3 = EleccionesVoto::where("eleccion_id", $elecciones[0]->id)
                ->where("partido_id", $partidos[2]->id)
                ->where("mesa_id", $localVotacion->id)
                ->first();

            if (!$votoexiste3) {
                $voto3 = new EleccionesVoto();
                $voto3->eleccion_id = $elecciones[0]->id;
                $voto3->partido_id = $partidos[2]->id;
                $voto3->departamento = $departamento->id;
                $voto3->provincia = $provincia->id;
                $voto3->distrito = $distrito->id;
                $voto3->datos_empresa_id = idEmpresa();
                $voto3->mesa_id = $localVotacion->id;
                $voto3->region = 'Distrital';
                $voto3->votos = $row['blancos'];
                $voto3->tipo_voto = 'Manual';
                $voto3->codigo = random_int(100000, 999999);
                $voto3->votos_departamento = $row['blancos'];
                $voto3->votos_provincia = $row['blancos'];
                $voto3->votos_distrito = $row['blancos'];
                $voto3->created_by = $this->usuario_creador;
                $voto3->updated_by = $this->usuario_creador;
                $voto3->fecha = date('Y-m-d');
                $voto3->save();
            } else {
                $votoexiste3->votos_departamento = $row['blancos'];
                $votoexiste3->votos_provincia = $row['blancos'];
                $votoexiste3->votos_distrito = $row['blancos'];
                $votoexiste3->votos = $row['blancos'];
                $votoexiste3->updated_by = $this->usuario_creador;
                $votoexiste3->save();
            }


            // volcado para partido 4

            $votoexiste4 = EleccionesVoto::where("eleccion_id", $elecciones[0]->id)
                ->where("partido_id", $partidos[3]->id)
                ->where("mesa_id", $localVotacion->id)
                ->first();

            if (!$votoexiste4) {
                $voto4 = new EleccionesVoto();
                $voto4->eleccion_id = $elecciones[0]->id;
                $voto4->partido_id = $partidos[3]->id;
                $voto4->departamento = $departamento->id;
                $voto4->provincia = $provincia->id;
                $voto4->distrito = $distrito->id;
                $voto4->datos_empresa_id = idEmpresa();
                $voto4->mesa_id = $localVotacion->id;
                $voto4->region = 'Distrital';
                $voto4->votos = $row['nulos'];
                $voto4->tipo_voto = 'Manual';
                $voto4->codigo = random_int(100000, 999999);
                $voto4->votos_departamento = $row['nulos'];
                $voto4->votos_provincia = $row['nulos'];
                $voto4->votos_distrito = $row['nulos'];
                $voto4->created_by = $this->usuario_creador;
                $voto4->updated_by = $this->usuario_creador;
                $voto4->fecha = date('Y-m-d');
                $voto4->save();
            } else {
                $votoexiste4->votos_departamento = $row['nulos'];
                $votoexiste4->votos_provincia = $row['nulos'];
                $votoexiste4->votos_distrito = $row['nulos'];
                $votoexiste4->votos = $row['nulos'];
                $votoexiste4->updated_by = $this->usuario_creador;
                $votoexiste4->save();
            }

            // volcado para partido 5

            $votoexiste5 = EleccionesVoto::where("eleccion_id", $elecciones[0]->id)
                ->where("partido_id", $partidos[4]->id)
                ->where("mesa_id", $localVotacion->id)
                ->first();

            if (!$votoexiste5) {
                $voto5 = new EleccionesVoto();
                $voto5->eleccion_id = $elecciones[0]->id;
                $voto5->partido_id = $partidos[4]->id;
                $voto5->departamento = $departamento->id;
                $voto5->provincia = $provincia->id;
                $voto5->distrito = $distrito->id;
                $voto5->datos_empresa_id = idEmpresa();
                $voto5->mesa_id = $localVotacion->id;
                $voto5->region = 'Distrital';
                $voto5->votos = $row['impugnados'];
                $voto5->tipo_voto = 'Manual';
                $voto5->codigo = random_int(100000, 999999);
                $voto5->votos_departamento = $row['impugnados'];
                $voto5->votos_provincia = $row['impugnados'];
                $voto5->votos_distrito = $row['impugnados'];
                $voto5->created_by = $this->usuario_creador;
                $voto5->updated_by = $this->usuario_creador;
                $voto5->fecha = date('Y-m-d');
                $voto5->save();
            } else {
                $votoexiste5->votos_departamento = $row['impugnados'];
                $votoexiste5->votos_provincia = $row['impugnados'];
                $votoexiste5->votos_distrito = $row['impugnados'];
                $votoexiste5->votos = $row['impugnados'];
                $votoexiste5->updated_by = $this->usuario_creador;
                $votoexiste5->save();
            }
        }
        return null;
    }
    public function rules(): array
    {
        return [];
    }
}
