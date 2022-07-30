<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\OptionMenuFormRequest;
use App\Models\Menu;
use App\Models\OptionMenu;
// use App\Models\Products;
use Illuminate\Http\Request;
use Exception;


class ApiOptionMenuController extends Controller
{
    public $componentName;

    public function __construct()
    {
        $this->componentName = 'Option Menu';
    }
    public function index(Request $request)
    {
        $estados = [0, 1];
        $query = trim($request->get('searchText'));
        if ($request) {
            $menu = Menu::all();
            $opmenu = DB::table('OptionMenu as p')
                // ->join('Menu as c', 'p.idMenu', 'c.idMenu')
                // ->select('c.idMenu', 'p.description', 'p.flag_estatus', 'p.codOption', 'c.codMenu', 'p.idOption')
                ->get();
                return $opmenu;
        }
    }
    public function store(OptionMenuFormRequest $request)
    {
        try {
            $mytime = Carbon::now('America/Lima');
            $fecha = $mytime->toDateTimeString();
            $opmenu = new OptionMenu();
            $opmenu->codOption =  strtoupper($request->get('codOption'));
            $opmenu->created_at = $fecha;
            $opmenu->idMenu = $request->get('idMenu'); //codmenu
            $opmenu->description = $request->get('description');
            $opmenu->flag_estatus = intval($request->get('flag_estatus'));
            $opmenu->save();
        } catch (Exception $e) {
            return  response()->json($e);
        }
        return \response($opmenu);
    }
    public function edit($id)
    {
        $estados = [0, 1];
        $optionmenus = DB::table('Menu')->get();
        return view("configuracion.optionmenu.edit", ["OptionMenu" => OptionMenu::findOrFail($id), "estados" => $estados, "optionmenus" => $optionmenus, "componentName" => $this->componentName]);
    }
    public function update(OptionMenuFormRequest $request, $id)
    {
        try {
            $mytime = Carbon::now('America/Lima');
            $fecha = $mytime->toDateTimeString();
            $opmenu = OptionMenu::findOrFail($id);
            $opmenu->codOption =  strtoupper($request->get('codOption'));
            $opmenu->created_up = $fecha;
            $opmenu->description = $request->get('description');
            $opmenu->idMenu = $request->get('idMenu'); //codmenu
            $opmenu->flag_estatus = intval($request->get('flag_estatus'));
            $opmenu->update();
        } catch (Exception $e) {
            return  response()->json($e);
        }
        return \response($opmenu);
          
    }

    public function destroy(Request $request, $id)
    {
        $opmenu = OptionMenu::findOrFail($id);
        $opmenu->delete();
        return \response(content: "el registro de id : $id fue elimindado");
    }
}
