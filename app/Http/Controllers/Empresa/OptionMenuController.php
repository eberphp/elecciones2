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


class OptionMenuController extends Controller
{
    public $componentName;

    public function __construct()
    {
        // $this->middleware('permission:ver-categoria', ['only' => ['index']]);
        // $this->middleware('permission:crear-categoria', ['only' => ['create', 'store']]);
        // $this->middleware('permission:editar-categoria', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:borrar-categoria', ['only' => ['destroy']]);

        // $this->middleware('auth');
        $this->componentName = 'Option Menu';
    }

    // public $bool=array(1,2);


    public function index(Request $request)
    {
        $estados = [0,1];
        $query = trim($request->get('searchText'));
        if ($request) {
            $menu = Menu::all();
            $opmenu = DB::table('OptionMenu as p')
                ->join('Menu as c', 'p.idMenu', 'c.idMenu')
                ->select('c.idMenu', 'p.description','p.flag_estatus','p.codOption','c.codMenu','p.idOption')  
                ->paginate(15);
            return view('configuracion.optionmenu.index', ["componentName" => $this->componentName, "estados" => $estados, "menu" => $menu, "opmenu" => $opmenu, "searchText" => $query]);
        }
    }
    // public function create()
    // { 
    //     $estados = ['PAGADO', 'EN DEUDA'];
    //     return view('configuracion.menu.create',  ["estados" => $estados]);
    // }
    public function store(OptionMenuFormRequest $request)
    {
        try {
            $mytime = Carbon::now('America/Lima');
            $fecha = $mytime->toDateTimeString();
            $opmenu = new OptionMenu();
            $opmenu->codOption =  strtoupper($request->get('codOption'));
            $opmenu->created_at = $fecha;
            $opmenu->idMenu = $request->get('idMenu');//codmenu
            $opmenu->description = $request->get('description');
            $opmenu->flag_estatus = intval($request->get('flag_estatus'));
            // $menu->flag_estatus = 1;
            $opmenu->save();
            return Redirect::to('configuracion/optionmenu')->with(['success' => $opmenu->codOption . ' agregado']);
        } catch (Exception $e) {
            return Redirect::to('configuracion/optionmenu')->with(['error' => $e->getMessage()]);
        }
    }
    public function edit($id)
    {
        $estados = [0,1];
        $optionmenus = DB::table('Menu')->get();
        return view("configuracion.optionmenu.edit", [ "OptionMenu" => OptionMenu::findOrFail($id),"estados" => $estados,"optionmenus" => $optionmenus, "componentName" => $this->componentName]);
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
            $opmenu->idMenu = $request->get('idMenu');//codmenu
            $opmenu->flag_estatus = intval($request->get('flag_estatus'));
            $opmenu->update();
            return Redirect::to('configuracion/optionmenu')->with(['success' => $opmenu->codOption . ' modificado']);
        } catch (Exception $e) {
            return Redirect::to('configuracion/optionmenu')->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request, $id)
    {
        try {
            if ($request->ajax()) {
                $opmenu = OptionMenu::findOrFail($id);
                if ($opmenu->delete()) {
                    return response()->json([
                        'success' => true,
                        'message' => '¡Satisfactorio!, Registro eliminado con éxito.',
                    ]);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => '¡Error!, No se pudo eliminar.',
                    ]);
                }
            }
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => '¡Error!, .' . $e->getMessage(),
                ]);
            }
        }
    }

    // public static function validate_destroy($id)
    // {
    //     return Products::where('idCategories', $id)->count() == 0 ? true : false;
    // }
}
