<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\Departamento;
use App\Models\EstadoEvaluacion;
use App\Models\TipoUbigeo;
use App\Models\TipoUsuario;
use App\Models\vinculo;
use Illuminate\Http\Request;

class ConfiguracionController extends Controller
{
    //
    public function cargo()
    {
        return view("intranet.pages.admin.configuracion.cargo");
    }
    public function funcion()
    {
        return view("intranet.pages.admin.configuracion.funcion");
    }
    public function estadoEvaluacion()
    {
        return view("intranet.pages.admin.configuracion.estadoEvaluacion");
    }
    public function vinculo()
    {
        return view("intranet.pages.admin.configuracion.vinculo");
    }
    public function tipoUsuario()
    {
        return view("intranet.pages.admin.configuracion.tipoUsuario");
    }
    public function tipoUbigeo()
    {
        return view("intranet.pages.admin.configuracion.tipoUbigeo");
    }
    public function tipoActividad()
    {
        return view("intranet.pages.admin.configuracion.tipoActividad");
    }
    public function area()
    {
        return view("intranet.pages.admin.configuracion.area");
    }
    public function prioridad()
    {
        return view("intranet.pages.admin.configuracion.prioridad");
    }
    public function estadoGestion()
    {
        return view("intranet.pages.admin.configuracion.estadoGestion");
    }
    public function usuarioResponsable()
    {
        return view("intranet.pages.admin.configuracion.usuarioResponsable");
    }
    public function estadoActividad()
    {
        return view("intranet.pages.admin.configuracion.estadoActividad");
    }
    public function estadoProceso()
    {
        return view("intranet.pages.admin.configuracion.estadoProceso");
    }
    public function personal()
    {
        $cargos = Cargo::all();
        $puestos = $cargos;
        $vinculos = vinculo::all();
        $tipoUsuarios=TipoUsuario::all();
        $tipoUbigeos=TipoUbigeo::all();
        $estadoEvaluaciones = EstadoEvaluacion::all();
        $departamentos = Departamento::all();
        return view("intranet.pages.admin.configuracion.personal", compact("tipoUbigeos","tipoUsuarios","cargos", "puestos", "vinculos", "departamentos","estadoEvaluaciones"));
    }
}
