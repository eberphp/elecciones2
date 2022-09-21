<?php

namespace App\Imports;

use App\Models\Perfil;
use App\Models\Personal;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use DateTime;
use Maatwebsite\Excel\Concerns\ToModel;
use function PHPUnit\Framework\isEmpty;

class PersonalWeb implements ToModel, WithHeadingRow, WithValidation
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
        $personalexiste = Personal::where("dni", $row["dni"])->first();
        if ($personalexiste) {
            return null;
        }
        $correoregistrado = Personal::where("correo", $row["correo"])->first();
        if ($correoregistrado) {
            return null;
        }
        $lastidpersonal = Personal::max("id");
        $lastidpersonal++;
        $personal = new Personal();
        $personal->id = $lastidpersonal;
        $personal->nombres = $row["nombres"];
        $personal->datos_empresa_id =  idEmpresa();
        $personal->empresa_id = idEmpresa();
        $personal->nombreCorto = isset($row["nombre_corto"]) ? $row["nombre_corto"] : "";
        $personal->telefono = isset($row["telefono"]) ? $row["telefono"] : "";
        $personal->nro_mesa = isset($row["nro_mesa"]) ? $row["nro_mesa"] : "";
        $personal->dni =  $row["dni"];
        $personal->clave = isset($row["clave"]) ? $row["clave"] : "";
        $personal->cargo_id =  0;
        $personal->funcion_id =  0;
        $personal->ppd ="";
        $personal->perfil =  "";
        $personal->evaluacion = "";
        $personal->foto ="";
        $personal->cv = "";
        $personal->url_facebook =  "";
        $personal->url_1 =  "";
        $personal->url_2 =  "";
        $personal->puesto_id =  0;
        $personal->referencias = "";
        $personal->estado = "";
        $personal->vinculo_id =  0;
        $personal->sugerencias =  "";
        $personal->tipo_usuarios_id =  0;
        $personal->asignar_usuarios = "";
        $personal->password =  Hash::make($row["clave"]);
        $personal->fecha_ingreso = now();

        $personal->correo = isset($row["correo"]) ? $row["correo"] : "";
        $personal->observaciones =  "";
        $personal->tipo_ubigeo = 0;
        $personal->rol_id = 1;
        $personal->departamento =  0;
        $personal->provincia = 0;
        $personal->distrito =  0;
        $personal->registrado_en = "web";

        $personal->save();


        $lastidperfil = Perfil::max("id");
        $lastidperfil++;
        $perfil = new Perfil();
        $perfil->id = $lastidperfil;
        $perfil->tipo = "persona";
        $perfil->codigo = isset($row["dni"]) ? $row["dni"] : "";
        $perfil->telefono = isset($row["telefono"]) ? $row["telefono"] : "";
        $perfil->nombreCorto = isset($row["nombre_corto"]) ? $row["nombre_corto"] : "";
        $perfil->docIdentidad = isset($row["dni"]) ? $row["dni"] : "";
        $perfil->idUsuarioCreador = $this->usuario_creador;
        $perfil->save();

        //dd(idEmpresa());

        $user = new User();
        $user->perfil_id = $lastidperfil;
        $user->idPersonal = $lastidpersonal;
        $user->password = Hash::make($row["clave"]);
        $user->clave = $row["clave"];
        $user->datos_empresa_id =  idEmpresa();
        //$user->clave = $request->clave;
        $user->email = $row["correo"];
        $user->save();

        return null;
    }
    public function rules(): array
    {
        return [
            'dni' => 'required',
            'correo' => 'required',
            'nombres' => 'required',
            'clave' => 'required'
        ];
    }
}
