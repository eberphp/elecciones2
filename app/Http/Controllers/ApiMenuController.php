<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\MenuFormRequest;
use App\Models\Menu;
use Validator;

// use App\Models\Products;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Lcobucci\JWT\Validation\Constraint\ValidAt;

class ApiMenuController extends Controller
{
    public $componentName;

    public function __construct()
    {
        $this->componentName = 'Menu';
    }

    public function index(Request $request)
    {
        $estados = [0, 1];
        $query = trim($request->get('searchText'));
        if ($request) {
            $menu = Menu::orderByDesc('idMenu')->get();
            return $menu;
        }
    }
    public function create()
    {
        $estados = ['PAGADO', 'EN DEUDA'];
        return view('configuracion.menu.create',  ["estados" => $estados]);
    }
    public function store(MenuFormRequest $request)
    {
        try {
            $mytime = Carbon::now('America/Lima');
            $fecha = $mytime->toDateTimeString();
            $menu = new Menu();
            $menu->codMenu =  strtoupper($request->get('codMenu'));
            $menu->created_at = $fecha;
            $menu->description = $request->get('description');
            $menu->flag_estatus = intval($request->get('flag_estatus'));
            $menu->save();
        } catch (Exception $e) {
            return  response()->json($e);
        }
        return \response($menu);
    }

    public function edit($id)
    {
        $estados = [0, 1];
        return view("configuracion.menu.edit", ["menu" => Menu::findOrFail($id), "estados" => $estados, "componentName" => $this->componentName]);
    }
    public function update(MenuFormRequest $request, $id)
    {
        try {
            $mytime = Carbon::now('America/Lima');
            $fecha = $mytime->toDateTimeString();
            $menu = Menu::findOrFail($id);
            $menu->codMenu =  strtoupper($request->get('codMenu'));
            $menu->create_ap = $fecha;
            $menu->description = $request->get('description');
            $menu->flag_estatus = intval($request->get('flag_estatus'));
            $menu->update();
        } catch (Exception $e) {
            return  response()->json($e);
        }
        return \response($menu);
    }

    public function destroy(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();
        return \response(content: "el registro de id : $id fue elimindado");
    }
}
